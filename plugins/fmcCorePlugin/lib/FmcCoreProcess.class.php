<?php

class FmcCoreProcess {

    public function __construct () {
    
        $this->controller = sfContext::getInstance()->getController();
        $this->user = sfContext::getInstance()->getUser();
        
    }
    
    public function form ($form, $request, $url) {
        
        if ($request->isMethod('post')) {
            
            $form->bind ($request->getParameter($form->getName()));
            
            if ($form->isValid()) {
                
                $form->save();
                $this->user->setFlash('success', 'Record is saved!');
                $this->controller->redirect ($url);
            
            } else {
                
                $this->user->setFlash ('error', 'Error saving the record!');
                
            }
        }
    
    }
    
}
