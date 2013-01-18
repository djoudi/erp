<?php

class whDayForm
{
    public static function processDailyBreaks ($form, $request, $redirectUrl = NULL)
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
                
                $day = Doctrine::getTable('WorkingHourDay')->getDraftDate ($date);
                
                $day->setDailyBreaks ($values['total_Daily_Breaks']);
                
                $day->save();
                #$form->save();
                
                $controller->redirect ($redirectUrl);
                
                $user->setFlash('success', "Daily breaks saved successfuly.");
            }
            else
            {
                $user->setFlash('error', $err);
            }
        }
    }
    
    
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
                $start = Fmc_Core_Time::TimeToStamp ($values['start_Time']);
                $end = 0;
                
                #if (isset($values['end_Time'])) // @TODO : check what's this
                    if ($values['end_Time'])
                        $end = Fmc_Core_Time::TimeToStamp ($values['end_Time']);
                
                if ($end && ($start>=$end))
                    $err = "Start time should be before end.";
                
            }
            if (!$err)
            {
                $day = Doctrine::getTable('WorkingHourDay')->getDraftDate ($date);
                if (!$day) $err = "Day not found!";
            }
            
            if (!$err)
            {
                foreach ($day->getWorkingHourRecords() as $record)
                {
                    $recordStart = Fmc_Core_Time::TimeToStamp ($record['start_Time']);
                    $recordEnd = $record['end_Time'] ? Fmc_Core_Time::TimeToStamp ($record['end_Time']) : $recordStart;
                    if
                    (
                        ( ($recordStart > $start) && ($recordStart < $end) ) ||
                        ( ($recordEnd > $start) && ($recordEnd < $end) ) || 
                        ( ($start > $recordStart) && ($start < $recordEnd) ) ||
                        ( ($end > $recordStart) && ($end < $recordEnd) ) ||
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
