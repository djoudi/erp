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
    
    
    public static function getUserLeaveUsage ($type_id, $user_id)
    {
        $count = Doctrine::getTable('WorkingHourDay')
            ->createQuery ('q')
            ->leftJoin ('q.LeaveRequest l')
            ->addWhere ('l.type_id = ?', $type_id)
            ->addWhere ('q.user_id = ?', $user_id)
            ->addWhere ('q.leave_id IS NOT NULL')
            ->addWhere ('q.status = ?', 'Accepted')
            ->count();
        return $count;
    }
    
    
    public static function getHasEnoughLeaveLimit ($type_id, $user_id)
    {
        $used = Fmc_Wh_Day::getUserLeaveUsage($type_id, $user_id);
        $available = Fmc_Wh_Day::getLeaveLimit($type_id, $user_id);
        return $available > $used;
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
    
    
    public static function getMultiplier ($date)
    {
        $timestamp = strtotime($date);
        $dayoftheweek = date ("N", $timestamp);
        
        if ($dayoftheweek > 5) // if weekend
        {
            $holiday = 1;
        }
        elseif (Doctrine::getTable('Holiday')->findOneByDay($date))
        {
            $holiday = 1;
        }
        else $holiday = 0;
        
        if ($holiday)
        {
            $param = Doctrine::getTable('WorkingHourParameter')->findOneByParam('WeekendMultiplier');
            $multiplier = $param['value'];
        }
        else $multiplier = 1;
        
        return $multiplier;
    }
    
    
    public static function getStatus ($date)
    {
        $user = sfContext::getInstance()->getUser();
        $user_id = $user->getGuardUser()->getId();
        
        $whday = Doctrine::getTable('WorkingHourDay')->getActiveForUserDate($user_id, $date);
        
        if ($whday) 
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
