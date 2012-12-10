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
    
    
    private function getProcessVars (sfWebRequest $request)
    {
        
        // Checking if the processing exists in the session
        
        $projectid = $this->getUser()->getAttribute('costFormProcess_projectid');
        
        if (!$projectid)
        {
            $this->getUser()->setFlash('notice', 'Your last invoicing could not be found.');
            
            $this->redirect($request->getReferer());
        }
        
        // Trying to fetch the project information
        
        $this->project = Doctrine::getTable('Project')->findOneById ($projectid);
        
        $this->forward404Unless ($this->project);
        
        // Fetching the cfi's from the session
        
        $invoiced = $this->getUser()->getAttribute('costFormProcess_invoiced');
        
        $notInvoiced = $this->getUser()->getAttribute('costFormProcess_notInvoiced');
        
        $this->invoicedCount = count($invoiced);
        
        $this->notInvoicedCount = count($notInvoiced);
    
        // Creating sub-array for each invoicing array
        
        $this->invoiced = array();
        
        $this->notInvoiced = array();
        
        $currencies = Doctrine::getTable('Currency')->getActive();
        
        foreach ($currencies as $currency)
        {
            $this->invoiced[$currency->id]= array();
            $this->notInvoiced[$currency->id]= array();
        }
        
        // Filling sub-arrays with related currency's cfi
        
        foreach ($invoiced as $cfi) array_push ($this->invoiced[$cfi->currency_id], $cfi);
        
        foreach ($notInvoiced as $cfi) array_push ($this->notInvoiced[$cfi->currency_id], $cfi);
    }
    
    
    ################################################################################################
    
    
    public function executeReport (sfWebRequest $request)
    {
        $this->getProcessVars($request);
        
        if (!$this->invoicedCount and !$this->notInvoicedCount)
        {
            $this->getUser()->setFlash('notice', "No cost selected to be processed.");
            $this->redirect($request->getReferer());
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
            ->setCellValue('B1', $this->project->getCustomers()->__toString())
            ->setCellValue('B2', $this->project->getCode())
            ->setCellValue('B3', $this->getUser()->getGuardUser()->__toString())
            ->setCellValue('B4', date("d-m-Y H:m"));
        
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
                        ->setCellValue("C$row", $item->getDescription())
                        ->setCellValue("D$row", $item->getVats()->getRate())
                        ->setCellValue("E$row", $item->getWithoutVat()." ".$item->getCurrencies()->__toString())
                        ->setCellValue("F$row", $item->getAmount()." ".$item->getCurrencies()->__toString())
                        ->setCellValue("G$row", $item->getReceiptNo())
                        ->setCellValue("H$row", $item->getInvoiceTo())
                        ->setCellValue("I$row", $item->getInvoiceNo())
                        ->setCellValue("J$row", $item->getInvoiceDate());
                    $row++;
                }
            
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue("C$row", "Total")
                    ->setCellValue("E$row", $sumexclvat." ".$item->getCurrencies()->__toString())
                    ->setCellValue("F$row", $suminclvat." ".$item->getCurrencies()->__toString());
                
                $row+=3;
            }
        }
        
        $objPHPExcel->getActiveSheet()->setTitle('Cost Invoicing');
        
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="costinvoicing-'.$this->project->getCode().'.xls"');
        header('Cache-Control: max-age=0');
        
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        
        $this->$this->redirect($request->getReferer());
    }
    
    
    ################################################################################################
    
    
    public function executeList (sfWebRequest $request)
    {
        
        $this->project = Doctrine::getTable('Project')->findOneById ($request->getParameter('id'));
        
        $this->forward404Unless ($this->project);
        
        $this->costFormItems = Doctrine::getTable('CostFormItem')->getActiveByProject($this->project->getId());
        
        if ($request->isMethod('post'))
        {
            $this->invoiced = array();
            $this->notInvoiced = array();
            
            foreach ($this->costFormItems as $cfi)
            {
                if ( $input = $request->getParameter($cfi->id) )
                {
                    if (isset($input['toBeInvoiced']))
                    {
                        # if it is do not invoice
                        if ($input['toBeInvoiced']=='dni')
                        {
                            array_push($this->notInvoiced, $cfi);
                            $cfi->dontInvoice = true;
                            $cfi->is_Processed = true;
                            $cfi->save();
                        }
                    }
                    elseif (isset($input['invoice_No']))
                    {
                        if ($input['invoice_No'])
                        {
                            array_push($this->invoiced, $cfi);
                            
                            $cfi->invoice_No = $input['invoice_No'];
                            
                            if ($input['invoice_Date'])
                                $cfi->invoice_Date = $input['invoice_Date'];
                            else
                                $cfi->invoice_Date = NULL;
                            
                            $cfi->is_Processed = true;
                            $cfi->save();
                        }
                    }
                }
            }
            
            $this->getUser()->setAttribute('costFormProcess_invoiced', $this->invoiced);
            $this->getUser()->setAttribute('costFormProcess_notInvoiced', $this->notInvoiced);
            $this->getUser()->setAttribute('costFormProcess_projectid', $this->project->getId());
            
            $this->getUser()->setFlash('success', 'Cost forms you have selected has been processed.');
            $this->redirect($this->getController()->genUrl("@costFormProcess_report"));
        }
    }
    
}
