<?php

abstract class PluginWorkingHourRecord extends BaseWorkingHourRecord
{
    
    public function save (Doctrine_Connection $conn = null)
    {
        parent::save($conn);
        
        $curDay = $this->getDay();
        $day = Doctrine::getTable("workingHourDay")->getActiveDate($curDay["date"], $curDay["employee_id"]);
        
        $day->setBalance (whDayUpdateSave::updateBalance($day));
        $day->save();
        
        return parent::save($conn);
    }
    
}
