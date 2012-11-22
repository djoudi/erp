<?php

class Fmc_Wh_Day
{
    
    public static function getGoodDate ($date)
    {
        $output = date('Y-m-d, D', strtotime($date));
        if ($date == date('Y-m-d'))
            $output .= ' (Today)';
        elseif ($date == date('Y-m-d', strtotime('yesterday'))) 
            $output .= ' (Yesterday)';
        elseif ($date == date('Y-m-d', strtotime('tomorrow')))
            $output .= ' (Tomorrow)';
        return $output;
    }
    
    
    // @TODO : Move these to Fmc_Wh_DayLeave class
    
    public static function getHasEnoughLeaveLimit ($type_id, $user_id)
    {
        $used = Fmc_Wh_Day::getUserLeaveUsage($type_id, $user_id);
        $available = Fmc_Wh_Day::getLeaveLimit($type_id, $user_id);
        return $available > $used;
    }
    
    
    
    public static function getUserLeaveUsage ($type_id, $user_id)
    {
        return Doctrine::getTable('WorkingHourDay')->getUsedLeaveCount($type_id, $user_id);
    }
    
    
    
    public static function getMyLeaveUsage ($type_id)
    {
        $myUserId = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        return Fmc_Wh_Day::getUserLeaveUsage ($type_id, $myUserId);
    }
    
    
        
    public static function getLeaveLimit ($type_id, $user_id)
    {
        $mylimits = Doctrine::getTable('LeaveRequestLimit')
            ->createQuery ('q')
            ->addWhere ('q.user_id = ?', $user_id)
            ->addWhere ('q.type_id = ?', $type_id)
            ->fetchOne();
        if ($mylimits)
        {
            $limit = $mylimits['leaveLimit'];
        } else {
            $type = Doctrine::getTable('LeaveType')->findOneById($type_id);
            $limit = $type['default_Limit'];
        }
        return $limit;
    }
    
    
    
    public static function getMyLeaveLimit ($type_id)
    {
        $myUserId = sfContext::getInstance()->getUser()->getGuardUser()->getId();
        return Fmc_Wh_Day::getLeaveLimit ($type_id, $myUserId);
    }
    
    
    /* MOVE THIS TO MODEL */
    public static function getStatus ($date)
    {
        if ($whday = Doctrine::getTable('WorkingHourDay')->getMyActiveForDate($date))
        {
            if ($whday['leave_id']) $status = "leave";
            else $status = "workday";
        }
        else
        {
            $status = "empty";
        }
        return $status;
    }


}
