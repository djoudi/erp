<?php

abstract class BasecostFormReportActions extends sfActions
{
  public function executeIndex (sfWebRequest $request)
  {
    $this->resultlimit = 250;
    
    // Edit these variables
    $_q = Doctrine_Query::create()
      ->from ('CostFormItem cfi')
      ->leftJoin ('cfi.CostForms cf')
      ->limit ($this->resultlimit)
      ->orderBy ('cfi.created_at DESC')
      ->addWhere ('cf.issent = ?', true);
    $filterClass = new FmcFilter('filter_costFormItemReport_list');
    $this->costFormItems = $filterClass->initFilterForm($request, $_q)->execute();
    
    // Do not touch here
      if ($request->hasParameter('_reset')) $filterClass->resetForm ();
      $this->filter = $filterClass->getFilter();
      $this->filtered = $filterClass->getFiltered();
    
    $this->resultslimited = false;
    if (count($this->costFormItems) == $this->resultlimit)
      $this->resultslimited = true;
  }
}
