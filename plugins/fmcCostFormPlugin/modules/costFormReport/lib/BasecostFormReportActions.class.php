<?php

abstract class BasecostFormReportActions extends sfActions
{
  ######################################################################################################
  
  private function getFilters() { return $this->getUser()->getAttribute('cf_filters', array()); }
  private function setFilters($filters) { $this->getUser()->setAttribute('cf_filters', $filters); }
  private function initFilterForm(sfWebRequest $request, Doctrine_Query $q)
  {
    $this->filter = $filterForm = new filter_costFormItemReport_list($this->getFilters()); #degistirilecek
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
  
  ######################################################################################################
  
  public function executeIndex (sfWebRequest $request)
  {
    $_q = Doctrine_Query::create()
      ->from('CostFormItem cfi')
      ->leftJoin('cfi.CostForms cf')
      ->where('cf.issent = ?', true);
    $q = $this->initFilterForm($request, $_q);
    $this->costFormItems = $q->execute();
  }
  
  
  
  
  
  
  
}


























