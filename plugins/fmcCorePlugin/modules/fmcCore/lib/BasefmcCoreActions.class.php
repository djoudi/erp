<?php

abstract class BasefmcCoreActions extends sfActions
{
    public function executeSearchupdate (sfWebRequest $request)
    {
        if ($tableName = $request->getParameter('tablename'))
        {
            $items = Doctrine::getTable('Customer')->findAll();
            foreach ($items as $item)
            {
                $item->updateLuceneIndex();
            }
            $this->getUser()->setFlash('success', $tableName." search indexes built successfuly.");
        }
        else
        {
            $this->getUser()->setFlash('notice', 'Please specify a table name.');
        }
        
        $url = $this->getController()->genUrl('@homepage');
        $this->redirect ($url);
        
    }
    
}
