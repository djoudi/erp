<?php

abstract class PluginWorkingHourDay extends BaseWorkingHourDay
{
    
    public function getFirst ($type = NULL)
    {
        $q = Doctrine::getTable ('WorkingHourRecord')
            ->createQuery ('r')
            ->addWhere ('r.day_id = ?', $this->getId());
        if ($type) $q->addWhere ('r.recordType = ?', $type);
        $q->limit(1);
        return $q->fetchOne();
    }
    
    
    public function calculateMultiplier()
    {
        $timestamp = strtotime($this->getDate());
        $dayoftheweek = date ("N", $timestamp);
        
        if ($dayoftheweek > 5) // if weekend
        {
            $holiday = 1;
        }
        elseif (Doctrine::getTable('Holiday')->findOneByDay($this->getDate())) // if holiday
        {
            $holiday = 1;
        }
        else $holiday = 0; // not holiday
        
        if ($holiday)
        {
            $param = Doctrine::getTable('WorkingHourParameter')->findOneByParam('WeekendMultiplier');
            $multiplier = $param['value'];
        }
        else $multiplier = 1;
        
        return $multiplier;
    }
    
}
