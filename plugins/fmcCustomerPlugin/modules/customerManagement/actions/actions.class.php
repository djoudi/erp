<?php

require_once dirname(__FILE__).'/../lib/BasecustomerManagementActions.class.php';

class customerManagementActions extends BasecustomerManagementActions
{
    
    
    public function executeSearch(sfWebRequest $request)
    {
        if ($request->isXmlHttpRequest())
        {
            $query = $request->getParameter('query');
            if ($query=="*")
            {
                $this->items = Doctrine::getTable('Customer')->findAll();
            }
            else
            {
                $this->items = Doctrine_Core::getTable('Customer')->getForLuceneQuery($query);
            }
            if (!$this->items)
            {
                return $this->renderText('No results.');
            } 
            return $this->renderPartial('customerManagement/items', array('items' => $this->items));
        }
    }
    
    
}
