<?php

class costFormUserActions extends sfActions
{
    
    public function executeChangepaidstatus (sfWebRequest $request)
    {
        $cost = Doctrine::getTable('CostFormItem')->getByIdUser ($request->getParameter('id'));
        
        $this->forward404Unless ($cost);
    
        $cost->changePaidStatus();
        
        $this->redirect ($request->getReferer());
    }
    
    
    ################################################################################################
    
    
    public function executeNew (sfWebRequest $request)
    {
        $this->form = new form_costFormUser_new();
        
        Fmc_Core_Form::Process ($this->form, $request, "@costFormUser_edit", NULL, true);
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
        
        if ($this->getUser()->getAttribute('cfi_id'))
        {
            $cfi_id = $this->getUser()->getAttribute('cfi_id');
            $this->getUser()->getAttributeHolder()->remove('cfi_id');
            
            $cfi_old = Doctrine::getTable('CostFormItem')
                ->createQuery ('cfi')
                ->leftJoin ('cfi.CostForms cf')
                ->addWhere ('id = ?', $cfi_id)
                ->addWhere ('cf.employee_id = ?', $this->getUser()->getGuardUser()->getId())
                ->limit (1)
                ->fetchOne();
            
            $cfi = $cfi_old->copy();
            
            $cfi_old->delete();
            
            $this->form = new form_costFormUser_newItem ($cfi);
        }
        
        $this->costForm = Doctrine::getTable('CostForm')->getByIdUser ($cf_id);
        
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
        
        Fmc_Core_Form::Process ($this->form, $request);
    }
    
    
    ################################################################################################
    
    
    public function executeDeleteForm (sfWebRequest $request)
    {
        $item = Doctrine::getTable('CostForm')->getByIdUser ($request->getParameter('id'));
        
        $this->forward404Unless($item);
        
        $item->deleteDraftForm();
        
        $this->redirect($request->getReferer());
    }
    
    
    ################################################################################################
    
    
    public function executeDeleteItem (sfWebRequest $request)
    {
        $item = Doctrine::getTable('CostFormItem')->getByIdUser ($request->getParameter('id'));
        
        $this->forward404Unless ($item);
        
        if ( $item->CostForms->isSent )
        {
            $this->getUser()->setFlash("error", sprintf("Cost form item with id %d cannot be deleted because it is active!", $item->id ));
        }
        else
        {
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
            ->addWhere('cf.employee_id = ?', $this->getUser()->getGuardUser()->getId());
        
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
        $item = Doctrine::getTable('CostForm')->getByIdUser ($request->getParameter('id'));
        
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
            $item->save();
        }
        
        $this->redirect($request->getReferer());
    }
    
    
    ################################################################################################
    
    
    public function executeReport (sfWebRequest $request)
    {
        $form = Doctrine::getTable('CostForm')->getByIdUser ($request->getParameter('id'));
        
        $this->forward404Unless ($form);
        
        // Excel parameters
        
        $template = sfConfig::get('sf_upload_dir')."/excelTemplates/costform.xls";
        $title = 'CostForm';
        $filename = "costform-{$form->id}.xls";
        
        // Preparing values
        
        $values = array();
        $values["E2"] = sfContext::getInstance()->getUser()->getGuardUser()->getName();
        $values["E3"] = $form->Projects->code;
        $values["L2"] = $form->id;
        $values["L3"] = $form->advanceReceived;
        
        $row = 7;
        
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
                    $sum += $cfi->amount;
                    
                    $values["B{$row}"] = $cfi->cost_Date;
                    $values["D{$row}"] = $cfi->description;
                    $values["G{$row}"] = $cfi->amount.' '.$cfi->getCurrencies()->__toString(). ' (%'.$cfi->getVats()->__toString().')';
                    $values["I{$row}"] = $cfi->receipt_No;
                    $values["K{$row}"] = $cfi->invoice_To;
                    
                    $row +=2;
                }
                $values["D{$row}"] = "Total";
                $values["G{$row}"] = $sum." ".$cfi->getCurrencies()->__toString();
                
                $row += 4;
            }
        }
        
        // Preparing output
        
        FmcExcel::prepare ($template, $title, $filename, $values, "A44", "A45");
        
        $this->redirect($request->getReferer());
    }
    
}
