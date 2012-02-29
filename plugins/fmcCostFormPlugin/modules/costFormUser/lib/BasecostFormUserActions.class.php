<?php

abstract class BasecostFormUserActions extends sfActions
{
  
  public function executeChangepaidstatus (sfWebRequest $request)
  {
    $cost = Doctrine::getTable('CostFormItem')
      ->createQuery('cfi')
      ->leftJoin('cfi.CostForms cf')
      ->addWhere('cfi.id = ?', $request->getParameter('id'))
      ->addWhere('cf.user_id = ?', $this->getUser()->getGuardUser()->getId())
      ->fetchOne();
    $this->forward404Unless ($cost);
    
    $cost->setIsPaid( ! $cost->getIsPaid() );
    $cost->setUpdatedBy($this->getUser()->getGuardUser()->getId());
    $cost->save();
    $this->redirect ($request->getReferer());
  }
  
  
  
  ################################################################################################
  
  private function getFilters() { return $this->getUser()->getAttribute('cf_filters', array()); }
  private function setFilters($filters) { $this->getUser()->setAttribute('cf_filters', $filters); }
  private function initFilterForm(sfWebRequest $request, Doctrine_Query $q)
  {
    $this->filterForm = $filterForm = new filter_costFormUser_list($this->getFilters()); #degistirilecek
    $params = $request->getParameter($filterForm->getName());
    if($request->isMethod('post'))
    {
      if($request->hasParameter('_reset'))
      {
        $this->setFilters(array());
        $this->redirect($request->getReferer());
      }
      $filterForm->bind($params);
      if($filterForm->isValid())
      {
        $this->setFilters($filterForm->getValues());
        $this->redirect($request->getReferer());
      }
    }
    $this->filtered = count($this->getFilters()) > 0;
    $filterForm->setQuery($q);
    return $filterForm->buildQuery($this->getFilters());
  }
  
  ################################################################################################
  
  public function executeNew (sfWebRequest $request)
  {
    $this->form = new form_costFormUser_new();
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $savedForm = $this->form->save();
        $savedForm->setCreatedBy($this->getUser()->getGuardUser()->getId());
        $savedForm->save();
        $this->redirect($this->getController()->genUrl('@costFormUser_edit?id='.$savedForm->id));
      }
    }
  }
  
  ################################################################################################
  
  public function executeEdit (sfWebRequest $request)
  {
    $this->costFormStatus = sfConfig::get("app_costForm_status", array());
    
    $this->costForm = Doctrine::getTable('costForm')->find($request->getParameter('id'));
    $this->forward404Unless($this->costForm);
    $this->costItems = Doctrine::getTable('costFormItem')->findBycostForm_id($this->costForm->id);
    
    $cfi = new CostFormItem($this->costForm);
    $cfi->setCostDate(date('Y-m-d'));
    $cfi->setCostformId($this->costForm->getId());
    $this->form = new form_costFormUser_newItem ($cfi);
    
    if ($request->isMethod('post'))
    {
      $this->form->bind ($request->getParameter($this->form->getName()));
      if ($this->form->isValid())
      {
        $object = $this->form->save();
        $object->setCreatedBy($this->getUser()->getGuardUser()->getId());
        $object->save();
        
        $this->redirect($request->getReferer());
      }
    }
  }
  
  ################################################################################################
  
  public function executeDeleteForm (sfWebRequest $request)
  {
    $form = Doctrine::getTable('costForm')->find($request->getParameter('id'));
    $this->forward404Unless($form);
    
    if ( $form->isSent )
    {
      $this->getUser()->setFlash("error", sprintf("Cost form with id %d cannot be deleted because it is active!", $form->id ));
    }
    else
    {
      $this->getUser()->setFlash("notice", sprintf("Cost form with id %d is deleted!", $form->id ));
      
      $form->setUpdatedBy($this->getUser()->getGuardUser()->getId());
      $object->save();
      $form->delete();
      
      $this->redirect($this->getController()->genUrl('@costforms'));
    }
    
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
    
    $userId = sfContext::getInstance()->getUser()->getGuardUser()->getId();
    
    $_q = Doctrine_Query::create()
      ->from('CostForm cf')
      ->leftJoin('cf.Projects p')
      ->where('p.status = ?', 'Active')
      ->andWhere('cf.user_id = ?', $userId);
    
    $q = $this->initFilterForm($request, $_q);
    
    $this->costForms = $q->execute();
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
      ->setCellValue('L3', $form->advanceRecieved)
      ->setCellValue('G57', $form->TotalSum.' TL')
      ->setCellValue('G59', $form->TotalSum-$form->advanceRecieved.' TL')
    ;
    foreach ($form->CostFormItems as $index=>$cfi)
    {
      $rowNo = ($index*2)+7;
      $objPHPExcel->setActiveSheetIndex(0)
        ->setCellValue('B'.$rowNo, $cfi->cost_Date)
        ->setCellValue('D'.$rowNo, $cfi->description)
        ->setCellValue('G'.$rowNo, $cfi->amount.' TL')
        ->setCellValue('I'.$rowNo, $cfi->receipt_No)
        ->setCellValue('K'.$rowNo, $cfi->invoice_To)
      ;
    }
    
    $objPHPExcel->getActiveSheet()->setTitle('CostForm');

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="costform-'.$form->id.'.xls"');
    header('Cache-Control: max-age=0');

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
    $objWriter->save('php://output');
    
    $this->$this->redirect($request->getReferer());
  }
  
  
}
