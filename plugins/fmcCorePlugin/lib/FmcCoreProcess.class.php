<?php

class FmcCoreProcess
{
    
    public static function form ($form, $request, $url, $errorUrl = NULL)
    {
        
        $controller = sfContext::getInstance()->getController();
        $user = sfContext::getInstance()->getUser();
        
        if ($request->isMethod('post'))
        {
            $form->bind ($request->getParameter($form->getName()));
            
            if ($form->isValid())
            {
                $form->save();
                $user->setFlash('success', 'Record is saved!');
                $controller->redirect ($url);
            } else {
                $user->setFlash ('error', 'Error saving the record!');
                if ($errorUrl)
                {
                    $controller->redirect ($errorUrl);
                }
            }
        }
    }
    
}
