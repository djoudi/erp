<?php

abstract class PluginLeaveRequest extends BaseLeaveRequest
{
    
    public function postSave ($event)
    {
        foreach ($this->getWorkingHourDay() as $day) $day->save();
    }
    
}
