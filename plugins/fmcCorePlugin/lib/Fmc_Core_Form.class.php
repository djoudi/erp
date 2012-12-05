<?php

class Fmc_Core_Form
{
    
    public static function Process ($form, $request, $redirectUrl = NULL, $errorUrl = NULL, $hasId = false)
    {
        $controller = sfContext::getInstance()->getController();
        
        $user = sfContext::getInstance()->getUser();
        
        if (!$redirectUrl) $redirectUrl = $request->getReferer();
        
        if ($request->isMethod('post'))
        {
            $form->bind ($request->getParameter($form->getName()));
            
            if ($form->isValid())
            {
                $object = $form->save();
                
                $user->setFlash('success', 'Record is saved!');
                
                if ($hasId) $redirectUrl = $controller->genUrl($redirectUrl.'?id='.$object->getId());
                
                $controller->redirect ($redirectUrl);
            }
            else 
            {
                $user->setFlash ('error', 'Error saving the record!');
                
                if ($errorUrl)
                {
                    $controller->redirect ($errorUrl);
                }
                
            } // End of isValid Check
            
        } // End of PostMethod
        
    } // End of Process
    
}
