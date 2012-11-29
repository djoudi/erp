<?php

class whDayForm
{
    
    public static function processNewday ($form, $request, $date = NULL)
    {
        $controller = sfContext::getInstance()->getController();
        $user = sfContext::getInstance()->getUser();
        
        if ($request->isMethod('post'))
        {
            $err = "";
            $form->bind ($request->getParameter($form->getName()));
            if ($form->isValid() && $date)
            {
                $values = $form->getValues();
                $enter = Fmc_Core_Time::TimeToStamp ($values['entrance']);
                $exit = Fmc_Core_Time::TimeToStamp ($values['exit']);
                
                if ($exit)
                {
                    if ($enter >= $exit)
                    {
                        $err = "Your entrance should be before exit.";
                    }
                }
                
                if (!$err)
                {
                    $dayObject = new WorkingHourDay ();
                    $dayObject->setEmployee ($user->getGuardUser());
                    $dayObject->setDate ($date);
                    $dayObject->setMultiplier ($dayObject->calculateMultiplier());
                    $dayObject->save();
                    
                    $enterObject = new WorkingHourRecord ();
                    $enterObject->setDay ($dayObject);
                    $enterObject->setRecordType ("Entrance");
                    $enterObject->setStartTime ($values['entrance']);
                    $enterObject->save();
                    
                    if ($exit)
                    {
                        $exitObject = new WorkingHourRecord ();
                        $exitObject->setDay ($dayObject);
                        $exitObject->setRecordType ("Exit");
                        $exitObject->setStartTime ($values['exit']);
                        $exitObject->save();
                    }
                    
                    $controller->redirect ($request->getReferer());
                }
            }
            else
            {
                $err = "You have a problem with your values.";
            }
            $user->setFlash('error', $err);
        }
    }
    
}
