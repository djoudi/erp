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
    
    public function verifyOrder()
    {
        $user = sfContext::getInstance()->getUser();
        $err = "";        
        
        if (!$err)
        {
            if (!$this->getOfficeEntrance() || !$this->getOfficeExit())
                $err = "You should enter office enter and exit times.";
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
                if ($io[$i-1]['type']=='Exit')
                {
                    $err = "You cannot work after exiting office.";
                    $type = "errorRowWork";
                    $id = $work['id'];
                    break;
                }
            }
        }
        
        // If employee worked enough for the day
        
        if (!$err)
        {
            $entrance = $this->coco ($this->getOfficeEntrance());
            $exit = $this->coco ($this->getOfficeExit());
            
            
            foreach ($io as $ee)
            {
                if ($ee['type']=="Entrance")
                {
                    $entrance += $this->coco ($ee['time']);
                }
            }
            foreach ($io as $ee)
            {
                if ($ee['type']=="Exit")
                {
                    $exit += $this->coco ($ee['time']);
                }
            }
            
            $err = $exit-$entrance;
            $err = $err / 3600;
            
        }
        
        $status = $err ? $err : "OK";
        $result = array('status'=>$status, 'errType'=>$type, 'errId'=>$id);
        return $result;
    }
    
    private function coco ($time)
    {
        $oldtz = date_default_timezone_get();
        date_default_timezone_set('UTC');
        $arr = explode(':', $time);
        $epoch = mktime($arr[0], $arr[1], $arr[2], "01", "01", "1970");
        date_default_timezone_set($oldtz);
        return $epoch;
    }
    
}
