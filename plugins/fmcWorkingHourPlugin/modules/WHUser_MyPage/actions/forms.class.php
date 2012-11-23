<?php

class WHUser_MyPage_Forms
{
    public static function processNewDayForm ($form, $request)
    {
        $controller = sfContext::getInstance()->getController();
        $user = sfContext::getInstance()->getUser();
        
        if ($request->isMethod('post'))
        {
            $form->bind ($request->getParameter($form->getName()));
            if ($form->isValid())
            {
                $values = $form->getValues();
                $err = "";
                
                if ($values['office_Entrance']==$values['office_Exit'])
                {
                    $err = "Your entrance and exit hours cannot be the same.";
                }
                
                if (!$err)
                {
                    $day = Doctrine::getTable('WorkingHourDay')->findOneByDraft
                
            }
    }
}
