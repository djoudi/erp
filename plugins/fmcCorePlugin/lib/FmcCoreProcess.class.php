<?php

class FmcCoreProcess {

    public function __construct () {
    
        $this->controller = sfContext::getInstance()->getController();
        $this->user = sfContext::getInstance()->getUser();
        
    }
    
    public static function form ($form, $request, $url) {
        
        $controller = sfContext::getInstance()->getController();
        $user = sfContext::getInstance()->getUser();
        
        if ($request->isMethod('post')) {
            
            $form->bind ($request->getParameter($form->getName()));
            
            if ($form->isValid()) {
                
                $form->save();
                $user->setFlash('success', 'Record is saved!');
                $controller->redirect ($url);
            
            } else {
                
                $user->setFlash ('error', 'Error saving the record!');
                
            }
        }
    
    }
    
}
