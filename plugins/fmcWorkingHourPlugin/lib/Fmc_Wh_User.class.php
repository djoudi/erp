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
    
    public static function DeleteMyIo ($date, $id)
    {
        $user = sfContext::getInstance()->getUser();
        $item = Doctrine::getTable ('WorkingHourEntranceExit')
            ->createQuery ('w')
            ->leftJoin ('w.Day d')
            ->addWhere ('w.id = ?', $id)
            ->addWhere ('d.user_id = ?', $user->getGuardUser()->getId())
            ->addWhere ('d.date = ?', $date)
            ->addWhere ('d.status = ?', 'Draft')
            ->fetchOne();
        if ($item) $item->delete();
    }
    
    public static function DeleteMyWork ($date, $id)
    {
        $user = sfContext::getInstance()->getUser();
        $item = Doctrine::getTable ('WorkingHourWork')
            ->createQuery ('w')
            ->leftJoin ('w.Day d')
            ->addWhere ('w.id = ?', $id)
            ->addWhere ('d.user_id = ?', $user->getGuardUser()->getId())
            ->addWhere ('d.date = ?', $date)
            ->addWhere ('d.status = ?', 'Draft')
            ->fetchOne();
        if ($item) $item->delete();
    }
    
}
