<?php

abstract class BasecostFormUserActions extends sfActions
{
  
  public function executeChangepaidstatus (sfWebRequest $request)
  {
    $cost = $this->getUser()->getMyCost($request->getParameter('id'));
    $this->forward404Unless ($cost);
    $cost->changePaidStatus();
    $this->redirect ($request->getReferer());
  }
  
  ################################################################################################
  
  public function executeNew (sfWebRequest $request)
  {
    $this->form = new form_costFormUser_new();
    $processClass = new FmcProcessForm();
    $processClass->ProcessForm($this->form, $request, "@costFormUser_edit", true, true);
  }
  
  ################################################################################################
  
  public function executeEdit (sfWebRequest $request)
  {
    $cf_id = $request->getParameter('id');

    if ($cfi_id = $request->getParameter('cfi_id'))
    {      
      $this->getUser()->setAttribute('cfi_id', $cfi_id);
      $this->redirect($this->getController()->genUrl('@costFormUser_edit?id='.$cf_id));
    }
    elseif ($this->getUser()->getAttribute('cfi_id'))
    {
      $cfi_id = $this->getUser()->getAttribute('cfi_id');
      $this->getUser()->getAttributeHolder()->remove('cfi_id');
      
      $cfi_old = Doctrine::getTable('CostFormItem')
        ->createQuery ('cfi')
        ->leftJoin ('cfi.CostForms cf')
        ->addWhere ('id = ?', $cfi_id)
        ->addWhere ('cf.user_id = ?', $this->getUser()->getGuardUser()->getId())
        ->limit (1)
        ->fetchOne();
      $cfi = $cfi_old->copy();
      $cfi_old->delete();
      
      $this->form = new form_costFormUser_newItem ($cfi);
    }
    
    $this->costForm = Doctrine::getTable('costForm')->find($cf_id);
    $this->forward404Unless($this->costForm);
    $this->costItems = Doctrine::getTable('costFormItem')->findBycostForm_id($this->costForm->id);
    
    if (!$cfi_id)
    {
      $cfi = new CostFormItem($this->costForm);
      $cfi->setCostDate(date('Y-m-d'));
      $cfi->setCostformId($this->costForm->getId());
      $this->form = new form_costFormUser_newItem ($cfi);
    }
    
    $this->costFormStatus = sfConfig::get("app_costForm_status", array());
    
    $processClass = new FmcProcessForm();
    $processClass->ProcessForm($this->form, $request, "referer", false, false);
  }
  
  ################################################################################################
  
  public function executeDeleteForm (sfWebRequest $request)
  {
    $form = Doctrine::getTable('costForm')->find($request->getParameter('id'));
    $this->forward404Unless($form);
    // BURASINDA KISININ KENDINE AIT FORMLARINI GETIRSIN SADECE
    
    $form->deleteDraftForm();
    
    $this->redirect($request->getReferer());
  }
  
  ################################################################################################
  
  public function executeDeleteItem (sfWebRequest $request)
  {
    $item = Doctrine::getTable('costFormItem')->find($request->getParameter('id'));
    $this->forward404Unless ($item);
    
    if ( $item->CostForms->isSent )
    {
      $this->getUser()->setFlash("error", sprintf("Cost form item with id %d cannot be deleted because it is active!", $item->id ));
    }
    else
    {
      $item->setUpdatedBy($this->getUser()->getGuardUser()->getId());
      $item->save();
      $item->delete();
    }
    
    $this->redirect($request->getReferer());
  }
  
  ################################################################################################
  
  public function executeList (sfWebRequest $request)
  {
    $this->costFormStatus = sfConfig::get("app_costForm_status", array());
    
    // Edit these variables
    $_q = Doctrine_Query::create()
      ->from('CostForm cf')
      ->leftJoin('cf.Projects p')
      ->addWhere('p.status = ?', 'Active')
      ->addWhere('cf.user_id = ?', $this->getUser()->getGuardUser()->getId());
      
    $filterClass = new FmcFilter('filter_costFormUser_list');
    $this->costForms = $filterClass->initFilterForm($request, $_q)->execute();
    
    // Do not touch here
    if ($request->hasParameter('_reset')) $filterClass->resetForm ();
    $this->filter = $filterClass->getFilter();
    $this->filtered = $filterClass->getFiltered();
  }
  
  ################################################################################################
  
  public function executeSend (sfWebRequest $request)
  {
    $item = Doctrine::getTable('costForm')->find($request->getParameter('id'));
    $this->forward404Unless ($item);
    
    if ( $item->isSent )
    {
      $this->getUser()->setFlash("error", sprintf("This cost form id %d already sent!", $item->id ));
    }
    elseif ( !count($item->getCostFormItems()) )
    {
      $this->getUser()->setFlash("error", sprintf("You cannot send an empty cost form."));
    }
    else
    {
      $this->getUser()->setFlash("success", sprintf("Cost form with id %d is sent for processing!", $item->id ));
      $item->isSent = true;
      $item->setUpdatedBy($this->getUser()->getGuardUser()->getId());
      $item->save();
    }
    
    $this->redirect($request->getReferer());
  }
  
  ################################################################################################
  
  public function executeReport (sfWebRequest $request)
  {
    
    $form = Doctrine::getTable('costForm')->find($request->getParameter('id'));
    
    $xfile = sfConfig::get('sf_upload_dir')."/excelTemplates/costform.xls";
    $objReader = PHPExcel_IOFactory::createReader('Excel5');
    $objPHPExcel = $objReader->load($xfile);

    $objPHPExcel->setActiveSheetIndex(0)
      ->setCellValue('E2', sfContext::getInstance()->getUser()->getGuardUser()->getName())
      ->setCellValue('E3', $form->Projects->code)
      ->setCellValue('L2', $form->id)
      ->setCellValue('L3', $form->advanceRecieved);
      $row = 7;
    
    // Creating sub-array for each invoicing array
      $costs = array();
      $currencies = Doctrine::getTable('Currency')->getActive();
      foreach ($currencies as $currency)
      {
        $costs[$currency->id]= array();
      }
      foreach ($form->CostFormItems as $cfi) array_push ($costs[$cfi->currency_id], $cfi);
    
    foreach ($costs as $currency_id=>$list)
    {
      if (count($list)>0)
      {
        $sum = 0;      
        foreach ($list as $index=>$cfi)
        {
          //$rowNo = ($index*2)+7;
          $sum += $cfi->amount;
          $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('B'.$row, $cfi->cost_Date)
            ->setCellValue('D'.$row, $cfi->description)
            ->setCellValue('G'.$row, $cfi->amount.' '.$cfi->getCurrencies()->__toString(). ' (%'.$cfi->getVats()->__toString().')')
            ->setCellValue('I'.$row, $cfi->receipt_No)
            ->setCellValue('K'.$row, $cfi->invoice_To);
          $row +=2;
        }
        $objPHPExcel->setActiveSheetIndex(0)
          ->setCellValue("D$row", "Total")
          ->setCellValue("G$row", $sum." ".$cfi->getCurrencies()->__toString());
        $row += 4;
      }
    }
    
    $objPHPExcel->getActiveSheet()->setTitle('CostForm');
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="costform-'.$form->id.'.xls"');
    header('Cache-Control: max-age=0');
    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    
    $this->redirect($request->getReferer());
  }
  
  
}
