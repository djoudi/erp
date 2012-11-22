<?php

abstract class PluginWorkingHourDay extends BaseWorkingHourDay
{
    
    public function getActiveIORecords()
    {
        $q = Doctrine::getTable ('WorkingHourEntranceExit')
            ->createQuery ('io')
            ->addWhere ('day_id = ?', $this->id)
            ->orderBy ('time ASC');
        return $q->execute();
    }
    
    
    
    public function getActiveWorkRecords()
    {
        $q = Doctrine::getTable ('WorkingHourWork')
            ->createQuery ('q')
            ->leftJoin ('q.Project p')
            ->leftJoin ('q.WorkType w')
            ->addWhere ('day_id = ?', $this->id)
            ->orderBy ('start ASC');
        return $q->execute();
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
    
    
    
    public function verifyRecords()
    {
        $user = sfContext::getInstance()->getUser();
        $err = "";        
        
        if (!$err)
        {
            if (!$this->getOfficeEntrance() || !$this->getOfficeExit())
                $err = "You should enter office enter and exit hours.";
        }
        
        if (!$err)
        {
            if ($this->getOfficeEntrance() == $this->getOfficeExit())
                $err = "Your entrance and exit times cannot be same!";
        }
        
        if (!$err)
        {
            $w = $this->getActiveWorkRecords();
            if (!count($w)) $err = "You did not enter any work records.";
        }
        
        // If Entrance and exit are in order
        
        if (!$err)
        {
            $io = $this->getActiveIORecords();
            $prevType = "Entrance";
            for ($i=0; $i<count($io); $i++)
            {
                if ($io[$i]['type']==$prevType)
                {
                    $err = "You cannot enter office without leaving first.";
                    $type = "errorRowIO";
                    $id = $io[$i]['id'];
                    break;
                }       
                $prevType = $io[$i]['type'];
            }
            if (count($io) && $io[count($io)-1]['type']=="Exit")
            {
                $err = "Your re-entry to the office is missing.";
                $type = "errorRowIO";
                $id = $io[count($io)-1]['id'];
            }
        }
        
        // If Work records are between Entrance/Exit
        if (!$err)
        {
            foreach ($w as $work)
            {
                for ($i=0; $i<count($io); $i++)
                {
                    if ($io[$i]['time']>$work['start']) break;
                }
                if ($i>0)
                {
                    if ($io[$i-1]['type']=='Exit')
                    {
                        $err = "You cannot work after exiting office.";
                        $type = "errorRowWork";
                        $id = $work['id'];
                        break;
                    }
                }
            }
        }
        
        // If employee worked enough for the day
        if (!$err)
        {
            $entrance = Fmc_Core_Time::TimeToStamp ($this->getOfficeEntrance());
            $exit = Fmc_Core_Time::TimeToStamp ($this->getOfficeExit());
            
            foreach ($io as $ee)
                if ($ee['type']=="Entrance")
                    $entrance += Fmc_Core_Time::TimeToStamp ($ee['time']);
            
            foreach ($io as $ee)
                if ($ee['type']=="Exit")
                    $exit += Fmc_Core_Time::TimeToStamp ($ee['time']);
            
            foreach ($w as $work)
            {
                $exit += Fmc_Core_Time::TimeToStamp ($work['start']);
                $entrance += Fmc_Core_Time::TimeToStamp ($work['end']);
            }
            
            if ($exit-$entrance !=0) $err = "Your work hours and entrance/exit does not sum up.";
        }
        
        $status = $err ? $err : "OK";
        $result = array('status'=>$status, 'errType'=>$type, 'errId'=>$id);
        return $result;
    }
    
    
    
}
