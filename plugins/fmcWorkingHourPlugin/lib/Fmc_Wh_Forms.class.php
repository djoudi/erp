<?php

class Fmc_Wh_Forms
{
    
    public static function processNewDayForm ($form, $request, $date)
    {
        $controller = sfContext::getInstance()->getController();
        $user = sfContext::getInstance()->getUser();
        
        if ($request->isMethod('post'))
        {
            $form->bind ($request->getParameter($form->getName()));
            if ($form->isValid())
            {
                $values = $form->getValues();
                $ent = Fmc_Core_Time::TimeToStamp ($values['office_Entrance']);
                $exit = Fmc_Core_Time::TimeToStamp ($values['office_Exit']);
                $err = "";
                
                // Check if entrance and exit are the same
                
                if ( $ent == $exit )
                {
                    $err = "Your entrance and exit hours cannot be the same.";
                }
                
                // Get if existing day
                
                if (!$err)
                {
                    $day = Doctrine::getTable('WorkingHourDay')->getMyDraftForDate($date);
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
                    if (!$day) $day = Doctrine::getTable('WorkingHourDay')->getMyDraftForDate($date);
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
        }
    }

}
