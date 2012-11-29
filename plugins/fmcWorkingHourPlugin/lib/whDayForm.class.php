<?php

class whDayForm
{
    
    public static function processNewWork ($form, $request, $redirectUrl = NULL)
    {        
        if ($request->isMethod('post'))
        {
            if (!$redirectUrl) $redirectUrl = $request->getReferer();
            $controller = sfContext::getInstance()->getController();
            $user = sfContext::getInstance()->getUser();
            $date = $request->getParameter ('date');
            $err = "";
            
            $form->bind ($request->getParameter ($form->getName()));
            
            if (!$err)
            {
                if (!($form->isValid())) $err = "You have problems with your input.";
            }
            
            if (!$err)
            {
                $values = $form->getValues();
                $start = $values['start_Time'] ? Fmc_Core_Time::TimeToStamp ($values['start_Time']) : 0;
                $end = $values['start_Time'] ? Fmc_Core_Time::TimeToStamp ($values['end_Time']) : 0;
                
                $day = Doctrine::getTable('WorkingHourDay')->getDraftDate ($date);
                if (!$day) $err = "Day not found!";
            }
            
            if (!$err)
            {
                foreach ($day->getWorkingHourRecords() as $record)
                {
                    $recordStart = $record['start_Time'] ? Fmc_Core_Time::TimeToStamp ($record['start_Time']) : 0;
                    $recordEnd = $record['end_Time'] ? Fmc_Core_Time::TimeToStamp ($record['end_Time']) : 0;
                    if
                    (
                        ( ($recordStart > $start) && ($recordStart < $end) ) ||
                        ( ($recordEnd > $start) && ($recordEnd > $end) ) ||
                        ( ($recordStart==$start) && ($recordEnd==$end) )
                    )
                    {
                        $user->setFlash ('errorRow', $record['id']);
                        $err = "Overlaps with existing record.";
                        break;
                    }
                }
            }
            
            if (!$err)
            {
                $form->save();
                $controller->redirect ($redirectUrl);
                $user->setFlash('success', "Work record saved successfuly");
            }
            else
            {
                $user->setFlash('error', $err);
            }
        }
    }
    
    
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
