<?php

class Fmc_Wh_User
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
    
}
