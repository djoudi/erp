<?php

class WHUser_MyPage_Lib_Form
{
    public static function MyDay_AddWork ($form, $request, $url=NULL)
    {
        $controller = sfContext::getInstance()->getController();
        $user = sfContext::getInstance()->getUser();
        $user_id = $user->getGuardUser()->getId();
        if (!$url) $url = $request->getReferer();
        $date = $request->getParameter('date');
        
        if ($request->isMethod('post'))
        {
            $err = "";
            
            $form->bind ($request->getParameter($form->getName()));
            if ($form->isValid())
            {
                // Get values
                
                $values = $form->getValues();
                
                // Check if start < end
                
                if ($values['end']<=$values['start'])
                {
                    $err = "End time should be later than start time.";
                }
                
                // Check if day exists
                
                if (!$err) 
                {
                    $day = Doctrine::getTable('WorkingHourDay')->getActiveForUserDate($user_id,$date);
                    if (!$day) $err = "Day not found!";
                }
                
                // Check if before entrance
                
                if ($values['start']<$day['office_Entrance']) $err = "Record is before your office entrance";
                
                // Check if after exit
                
                if ($day['office_Exit'] && ($values['end']>$day['office_Exit'])) $err = "Record is after your office exit";
                
                // Get day records
                
                if (!$err)
                {
                    $dayIOrecords = $day->getActiveIORecords();
                    $dayWorkRecords = $day->getActiveWorkRecords();
                }
                
                // Check with IO records
                
                if (!$err)
                {
                    foreach ($dayIOrecords as $io)
                    {
                        if ( ($io['time']>$values['start']) && ($io['time']<$values['end']) )
                        {
                            $err = "Overlapping with an entrance/exit record.";
                            $user->setFlash('errorRowIO', $io['id']);
                            break;
                        }
                    }
                }
                
                // Check with Work records
                
                if (!$err)
                {
                    foreach ($dayWorkRecords as $w)
                    {
                        if ( ($values['start']>$w['start']) && ($values['start']<$w['end']) )
                        {
                            $err = "Start time is overlapping with another work time.";
                            $user->setFlash('errorRowWork', $w['id']);
                            break;
                        }
                        elseif ( ($values['end']>$w['start']) && ($values['end']<$w['end']) )
                        {
                            $err = "End time is overlapping with another work time.";
                            $user->setFlash('errorRowWork', $w['id']);
                            break;
                        }
                    }
                }
                
                // Save if no errors
                
                if (!$err)
                {
                    $object = new WorkingHourWork();
                    $object->setDayId ($day['id']);
                    $object->setProjectId ($values['project_id']);
                    $object->setTypeId ($values['type_id']);
                    $object->setStart ($values['start']);
                    $object->setEnd ($values['end']);
                    $object->setComment ($values['comment']);
                    $object->save();
                    
                    $user->setFlash('success', 'Record saved.');
                    $controller->redirect ($url);
                }
                
            }
            else $err = "Form is not valid. Please check your input";
            
            if ($err)
            {
                $user->setFlash('error', $err);
            }
        }
    }
    
    
    public static function MyDay_AddIo ($form, $request, $type, $url=NULL)
    {
        $controller = sfContext::getInstance()->getController();
        $user = sfContext::getInstance()->getUser();
        $user_id = $user->getGuardUser()->getId();
        if (!$url) $url = $request->getReferer();
        $date = $request->getParameter('date');
        
        if ($request->isMethod('post'))
        {
            $err = "";
            
            $form->bind ($request->getParameter($form->getName()));
            if ($form->isValid())
            {
                // Get values
                
                $values = $form->getValues();
                
                // Check if day exists
                
                $day = Doctrine::getTable('WorkingHourDay')->getActiveForUserDate($user_id,$date);
                if (!$day) $err = "Day not found!";
                
                // Check if between office first entrance / last exit
                
                if (!$err)
                {
                    if ( ($values['time']<=$day['office_Entrance']) || 
                        ($values['time']>=$day['office_Exit'] && $day['office_Exit']) 
                    )
                        $err = "Should be between office first entrance / last exit.";
                }
                
                // Get day records
                
                if (!$err)
                {
                    $dayIOrecords = $day->getActiveIORecords();
                    $dayWorkRecords = $day->getActiveWorkRecords();
                }
                
                // Check with IO records
                
                if (!$err)
                {
                    foreach ($dayIOrecords as $io)
                    {
                        if ($values['time']==$io['time'])
                        {
                            $err = "Duplicate entrance/exit time";
                            $user->setFlash('errorRowIO', $io['id']);
                            break;
                        }
                    }
                }
                
                // Check with Work records
                
                if (!$err)
                {
                    foreach ($dayWorkRecords as $w)
                    {
                        if ( ($values['time']>$w['start']) && ($values['time']<$w['end']) )
                        {
                            $err = "Entrance/exit cannot be inside work times.";
                            $user->setFlash('errorRowWork', $w['id']);
                            break;
                        }
                    }
                }
                
                // Save if NO errors
                
                if (!$err)
                {
                    $object = new WorkingHourEntranceExit();
                    $object->setDayId ($day['id']);
                    $object->setType ($type);
                    $object->setTime ($values['time']);
                    $object->save();
                    
                    $user->setFlash('success', 'Record saved.');
                    $controller->redirect ($url);
                }
                
            }
            else $err = "Form is not valid. Please check your input";
            
            if ($err)
            {
                $user->setFlash('error', $err);
            }
        }
    }
    
    
    
    public static function ProcessMyNewDay ($request, $form, $date)
    {
        $controller = sfContext::getInstance()->getController();
        $user = sfContext::getInstance()->getUser();
        
        if ($request->isMethod('post'))
        {
            $form->bind ($request->getParameter($form->getName()));
            if ($form->isValid())
            {
                $values = $form->getValues();
                
                $day = new WorkingHourDay();
                $day->setUserId ($user->getGuardUser()->getId());
                $day->setDate ($date);
                $day->setStatus ("Draft");
                $day->setMultiplier (Fmc_Wh_Day::getMultiplier($date));
                $day->save();
                
                $entrance = new WorkingHourEntranceExit();
                $entrance->setDay ($day);
                $entrance->setType ("Entrance");
                $entrance->setTime ($values["time"]);
                $entrance->save();
                
                $user->setFlash('success', 'Office day entrance saved.');
                $controller->redirect ($request->getReferer());
            }
            else
            {
                $user->setFlash('error', 'Problem occured saving the record! Please check your input.');
            }
        }
    }
    
}
