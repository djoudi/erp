<?php

class costFormProcessActions extends sfActions
{
    
    public function executeFilter (sfWebRequest $request)
    {
        $this->projectList = Doctrine::getTable('Project')->getActive();
        
        if ($request->isMethod('post'))
        {
            if ($projectid = $request->getParameter('projects'))
            {
                $this->redirect($this->getController()->genUrl('@costFormProcess_list?id='.$projectid ));
            }
        }
    }
    
    
    ################################################################################################
    
    private function getItemsOrdered ($invoicing)
    {
        $invoiced = $invoicing->getInvoiced();
        $notInvoiced = $invoicing->getNotInvoiced();
    }
    
    
    private function getProcessVars ($request)
    {
        $this->invoiced = array();
        $this->notInvoiced = array();
        
        $this->invoicing = Doctrine::getTable('CostFormInvoicing')->findOneById($request->getParameter('id'));
        
        $currencies = Doctrine::getTable('Currency')->getActive();
        
        foreach ($currencies as $currency)
        {
            $this->invoiced[$currency->id]= array();
            $this->notInvoiced[$currency->id]= array();
        }
        
        // Getting invoiced
        
        $invoiced = Doctrine::getTable('CostFormItem')->prepareInvoicingQuery ($this->invoicing->getId(), 0);
        
        $this->invoicedCount = count($invoiced);
        
        foreach ($invoiced as $cfi) array_push ($this->invoiced[$cfi['currency_id']], $cfi);
        
        // Getting un-invoiced
        
        $notInvoiced = Doctrine::getTable('CostFormItem')->prepareInvoicingQuery ($this->invoicing->getId(), 1);
        
        $this->notInvoicedCount = count($notInvoiced);
        
        foreach ($notInvoiced as $cfi) array_push ($this->notInvoiced[$cfi['currency_id']], $cfi);
    }
    
    
    ################################################################################################
    
    
    public function executeReport (sfWebRequest $request)
    {
        if ($request->getParameter('id'))        
        {
            $this->getProcessVars($request);
        }
        else
        {
            $this->invoicings = Doctrine::getTable('CostFormInvoicing')->findAll();
            $this->setTemplate ('invoicings');
        }
    }
    
    
    ################################################################################################
    
    
    public function executeExport (sfWebRequest $request)
    {
        $this->getProcessVars($request);
    
        $xfile = sfConfig::get('sf_upload_dir')."/excelTemplates/costform-invoicing.xls";
        
        $objReader = PHPExcel_IOFactory::createReader('Excel5');
        
        $objPHPExcel = $objReader->load($xfile);
        
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue ('A1', "Invoiced by {$this->invoicing->getEmployee()} on {$this->invoicing->invoicing_Date}")
            ->setCellValue ('A2', "Printed by {$this->getUser()->getGuardUser()} on ".date('Y-m-d H:i:s'))
            ->setcellValue ('A3', $_SERVER['HTTP_REFERER']);
        
        $row = 8;
        
        foreach ($this->invoiced as $currency_id=>$list)
        {
            if (count($list)>0)
            {
                $sumexclvat = 0;
                $suminclvat = 0;
                
                foreach ($list as $index=>$item)
                {
                    $sumexclvat += $item->withoutVat;
                    $suminclvat += $item->amount;
            
                    $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue("A$row", date ("d-m-Y", strtotime($item->cost_Date)) )
                        ->setCellValue("B$row", $item->getCostForms()->getUsers()->__toString())
                        ->setCellValue("C$row", $item->getCostForms()->getProjects()->getCode())
                        ->setCellValue("D$row", $item->getDescription())
                        ->setCellValue("E$row", $item->getVats()->getRate())
                        ->setCellValue("F$row", $item->getWithoutVat()." ".$item->getCurrencies()->__toString())
                        ->setCellValue("G$row", $item->getAmount()." ".$item->getCurrencies()->__toString())
                        ->setCellValue("H$row", $item->getReceiptNo())
                        ->setCellValue("I$row", $item->getInvoiceTo())
                        ->setCellValue("J$row", $item->getInvoiceNo())
                        ->setCellValue("K$row", $item->getInvoiceDate());
                    $row++;
                }
            
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("D$row", "Total")
                    ->setCellValue("F$row", $sumexclvat." ".$item->getCurrencies()->__toString())
                    ->setCellValue("G$row", $suminclvat." ".$item->getCurrencies()->__toString());
                
                $row+=3;
            }
        }
        
        $objPHPExcel->getActiveSheet()->setTitle("Cost Invoicing - {$this->invoicing['id']}");
        
        header('Content-Type: application/vnd.ms-excel');
        header("Content-Disposition: attachment;filename='costinvoicing-{$this->invoicing['id']}.xls'");
        header('Cache-Control: max-age=0');
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        
        $this->$this->redirect($request->getReferer());
    }
    
    
    ################################################################################################
    
    
    public function executeList (sfWebRequest $request)
    {
        $this->project = Doctrine::getTable('Project')->getActiveById ($request->getParameter('id'));
        
        $this->forward404Unless ($this->project);
        
        
        // Edit these variables
        
        $this->resultLimit = 100;
        
        $q = Doctrine::getTable ('Project')
            ->prepareInvoicingFilter ($this->project->getId(), $this->resultLimit);
        
        $filterClass = new FmcFilter('filter_costFormItem_process');
        
        $this->costFormItems = $filterClass->initFilterForm($request, $q)->execute();
        
        
        // Do not touch here
      
        if ($request->hasParameter('_reset')) $filterClass->resetForm ();
        $this->filter = $filterClass->getFilter();
        $this->filtered = $filterClass->getFiltered();
        
        
        // Processing POST
        
        if ($request->isMethod('post'))
        {
            $myUser = $this->getUser()->getGuardUser();
            
            $invoicing = new CostFormInvoicing();
            $invoicing->setEmployee ($myUser);
            $invoicing->setInvoicingDate (date("Y-m-d"));
            $invoicing->save();
            
            foreach ($this->costFormItems as $cfi)
            {
                if ( $input = $request->getParameter($cfi->id) )
                {
                    if (isset($input['toBeInvoiced']))
                    {
                        # if it is Do-Not-Invoice (DNI)
                        if ($input['toBeInvoiced']=='dni')
                        {
                            $cfi->dontInvoice = true;
                            $cfi->is_Processed = true;
                            $cfi->setInvoicedBy ($myUser);
                            $cfi->save();
                            
                            $invoiceItem = new CostFormInvoicingItem();
                            $invoiceItem->setCostFormInvoicing ($invoicing);
                            $invoiceItem->setCostItem ($cfi);
                            $invoiceItem->save();
                        }
                    }
                    elseif (isset($input['invoice_No']))
                    {
                        if ($input['invoice_No'])
                        {
                            $cfi->invoice_No = $input['invoice_No'];
                            $cfi->invoice_Date = $input['invoice_Date'] ? $input['invoice_Date'] : NULL;
                            $cfi->is_Processed = true;
                            $cfi->setInvoicedBy ($myUser);
                            $cfi->save();
                            
                            $invoiceItem = new CostFormInvoicingItem();
                            $invoiceItem->setCostFormInvoicing ($invoicing);
                            $invoiceItem->setCostItem ($cfi);
                            $invoiceItem->save();
                        }
                    }
                }
            }
            
            if (count($invoicing->getCostFormInvoicingItems()))
            {
                $this->getUser()->setFlash('success', 'Cost forms you have selected has been processed.');
                $this->redirect($this->getController()->genUrl("@costFormProcess_report?id=".$invoicing['id']));
            }
            else
            {
                $invoicing->delete();
                $this->getUser()->setFlash('notice', "No cost selected to be processed.");
            }
            
        }
    }
    
}
