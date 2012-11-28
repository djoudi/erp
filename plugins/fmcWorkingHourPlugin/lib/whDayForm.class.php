<?php

class whDayForm
{
    
    public static function processNewday ($form, $request, $date = NULL)
    {
        $controller = sfContext::getInstance()->getController();
        $user = sfContext::getInstance()->getUser();
        
        if ($request->isMethod('post') && $date)
        {
            $form->bind ($request->getParameter($form->getName()));
            if ($form->isValid())
            {
                $values = $form->getValues();
                $enter = Fmc_Core_Time::TimeToStamp ($values['entrance']);
                $exit = Fmc_Core_Time::TimeToStamp ($values['exit']);
                $err = "";
                
                if ($enter >= $exit)
                {
                    $user->setFlash('error', "Your entrance should be before exit.");
                }
                else
                {
                    $dayObject = new WorkingHourDay ();
                    $dayObject->setEmployee ($user->getGuardUser());
                    $dayObject->setDate ($date);
                    /* SET MULTIPLIER */
                    $dayObject->save();
                    
                    $enterObject = new WorkingHourRecord ();
                    $enterObject->setDay ($dayObject);
                    $enterObject->setRecordType ("Entrance");
                    $enterObject->setStartTime ($values['entrance']);
                    $enterObject->save();
                    
                    $exitObject = new WorkingHourRecord ();
                    $exitObject->setDay ($dayObject);
                    $exitObject->setRecordType ("Exitt");
                    $exitObject->setStartTime ($values['exit']);
                    $exitObject->save();
                    
                    $controller->redirect ($request->getReferer());
                }
            }
            else
            {
                $user->setFlash('error', "You have a problem with your values.");
            }
        }
    }
            
                /*
                
                // Get if existing day
                
                if (!$err)
                {
                    $day = Doctrine::getTable('WorkingHourDay')
                        ->getDraftForUserDate($user->getGuardUser()->getId(), $date);
                }
                
                // Check with current IO records
                
                if (!$err && $day)
                {
                    $ioS = $day->getActiveIORecords();
                    foreach ($ioS as $io)
                    {
                        if ( ( Fmc_Core_Time::TimeToStamp ($io['time']) == $ent) || 
                            ( Fmc_Core_Time::TimeToStamp ($io['time']) == $exit ) )
                        {
                            $err = "Cannot be same with your entrance/exit values";
                            $user->setFlash('errorRowIO', $io['id']);
                            break;
                        }
                    }
                }
                
                // Check with current work records
                
                if(!$err && $day)
                {
                    $wS = $day->getActiveWorkRecords();
                    foreach ($wS as $w)
                    {
                        if ( ( Fmc_Core_Time::TimeToStamp ($w['start']) < $ent) || 
                            ( Fmc_Core_Time::TimeToStamp ($w['end']) > $exit ) )
                        {
                            $err = "Entrance/Exit records conflict with your work records.";
                            $user->setFlash('errorRowWork', $w['id']);
                            break;
                        }
                    }
                }
                
                if (!$err)
                {
                    $form->save();
                    if (!$day) $day = Doctrine::getTable('WorkingHourDay')
                        ->getDraftForUserDate($user->getGuardUser()->getId(), $date);
                    $day->setMultiplier ($day->calculateMultiplier());
                    $day->save();
                    $controller->redirect ($request->getReferer());
                }
            }
            else $err = "You have a problem with your values.";
            
            if ($err)
            {
                $user->setFlash('error', $err);
            }
            */

}
