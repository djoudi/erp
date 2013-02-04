<?php

class costFormReportActions extends sfActions
{
    
    public function executeIndex (sfWebRequest $request)
    {
        $this->resultLimit = 50;
        
        // Edit these variables
    
        $_q = Doctrine_Query::create()
            ->from ('CostFormItem cfi')
            ->leftJoin ('cfi.Currencies cur')
            ->leftJoin ('cfi.CostForms cf')
            ->leftJoin ('cf.Projects p')
            ->leftJoin ('cf.Users u')
            ->limit ($this->resultLimit)
            ->addWhere ('cf.issent = ?', true);
        
        $filterClass = new FmcFilter('filter_costFormItemReport_list');
    
        $this->costFormItems = $filterClass->initFilterForm($request, $_q)->execute()->toArray();
        
        // Do not touch here
      
        if ($request->hasParameter('_reset')) $filterClass->resetForm ();
        
        $this->filter = $filterClass->getFilter();
        
        $this->filtered = $filterClass->getFiltered();
    }
    
}
