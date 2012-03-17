<?php

abstract class BaseworkingHourWorkTypeActions extends sfActions
{
  public function executeList (sfWebRequest $request)
  {
    // Filter: Edit these variables
      $_q = Doctrine_Query::create()
        ->from('WorkType wt')
        ->orderBy('title ASC');
      $filterClass = new FmcFilter('WorkTypeFormFilter');
    
    // Filter: Do not touch here
      $this->items = $filterClass->initFilterForm($request, $_q)->execute();
      if ($request->hasParameter('_reset')) $filterClass->resetForm ();
      $this->filter = $filterClass->getFilter();
      $this->filtered = $filterClass->getFiltered();
  }
  
  public function executeNew (sfWebRequest $request)
  {
    $this->form = new workTypeForm();
    $processClass = new FmcProcessForm();
    $processClass->ProcessForm($this->form, $request, "@workingHourWorkType_list", true);
  }
  
  public function executeEdit (sfWebRequest $request)
  {
    $this->item = Doctrine::getTable('WorkType')->findOneById ($request->getParameter("id"));
    $this->forward404Unless ($this->item);
    
    $this->form = new workTypeForm ($this->item);
    $processClass = new FmcProcessForm();
    $processClass->ProcessForm($this->form, $request, "@workingHourWorkType_list", false);
  }
  
}
