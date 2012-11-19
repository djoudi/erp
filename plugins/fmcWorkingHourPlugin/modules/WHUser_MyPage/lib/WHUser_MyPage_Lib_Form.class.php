<?php

class WHUser_MyPage_Lib_Form
{
    public static function DeleteMyDay ($date)
    {
        $user = sfContext::getInstance()->getUser();
        
        $day = Doctrine::getTable ('WorkingHourDay')
            ->createQuery ('d')
            ->addWhere ('d.user_id = ?', $user->getGuardUser()->getId())
            ->addWhere ('d.date = ?', $date)
            ->addWhere ('d.status = ?', 'Draft')
            ->fetchOne();
        
        if ($day)
        {
            #$day->getLeaveRequest()->delete(); /* @TODO : FIX THIS */
            $day->getWorkingHourEntranceExit()->delete();
            $day->getWorkingHourWork()->delete();
            $day->delete();
            
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
