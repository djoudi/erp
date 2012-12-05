<?php

abstract class PluginWorkingHourDay extends BaseWorkingHourDay
{
    
    public function getWorkRecords ()
    {
        $q = Doctrine::getTable ('WorkingHourRecord')
            ->createQuery ('r')
            ->addWhere ('r.day_id = ?', $this->getId())
            ->addWhere ('r.recordType = ?', 'Work')
            ->orderBy ('r.start_Time ASC');
        return $q->execute();
    }
    
    public function getIORecords ()
    {
        $q = Doctrine::getTable ('WorkingHourRecord')
            ->createQuery ('r')
            ->addWhere ('r.day_id = ?', $this->getId())
            ->addWhere ('r.recordType <> ?', 'Work')
            ->orderBy ('r.start_Time ASC');
        return $q->execute();
    }
    
    
    public function getFirst ($type = NULL)
    {
        $q = Doctrine::getTable ('WorkingHourRecord')
            ->createQuery ('r')
            ->addWhere ('r.day_id = ?', $this->getId())
            ->orderBy ('r.start_Time ASC')
            ->limit(1);
        if ($type) $q->addWhere ('r.recordType = ?', $type);
        return $q->fetchOne();
    }
    
    public function getLast ($type = NULL)
    {
        $q = Doctrine::getTable ('WorkingHourRecord')
            ->createQuery ('r')
            ->addWhere ('r.day_id = ?', $this->getId())
            ->orderBy ('r.start_Time DESC')
            ->limit(1);
        if ($type) $q->addWhere ('r.recordType = ?', $type);
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
    
    
    
    public function verifyRecords ()
    {
        $err = NULL;
        $errorRow = NULL;
        
        if (!$err)
        {
            $first = $this->getFirst();
            
            if ( $first->getRecordType() != "Entrance" )
                {
                    $err = "You should enter office first";
                    $errorRow = $first->getId();
                }
            
            elseif ( ! ($entrance = $this->getFirst("Entrance") ) )
                $err = "You don't have a day entrance.";
            
            elseif ( ! ($exit = $this->getLast("Exit") ) )
                $err = "You don't have a day exit.";
            
            elseif ( ! ($entrance->getStartTime() < $exit->getStartTime()) )
                $err = "Your entrance should be before your exit.";
            
            elseif (!$this->getFirst("Work"))
                $err = "You don't have any work records.";
        }
        
        // If Entrance and exit are in order
        
            if (!$err)
            {
                $io = $this->getIORecords();
                
                $prevType = "Exit";
                for ($i=0; $i<count($io); $i++)
                {
                    if ($io[$i]['recordType']==$prevType)
                    {
                        $err = "Your entrance and exits are not in order.";
                        $errorRow = $io[$i]['id'];
                        break;
                    }       
                    $prevType = $io[$i]['recordType'];
                }
            }
        
        // If Work records are between Entrance/Exit
        
            if (!$err)
            {
                $w = $this->getWorkRecords ();
                
                foreach ($w as $work)
                {
                    for ($i=0; $i<count($io); $i++)
                    {
                        if ($io[$i]['start_Time']>$work['start_Time']) break;
                    }
                    if ($i>0)
                    {
                        if ($io[$i-1]['recordType']=='Exit')
                        {
                            $err = "You cannot work after exiting office.";
                            $errorRow = $work['id'];
                            break;
                        }
                    }
                }
            }
        
        // If employee worked enough for the day
        
            if (!$err)
            {
                $inTime = 0;
                $outTime = 0;
                
                foreach ($io as $ee)
                    if ($ee['recordType']=="Entrance")
                        $inTime += Fmc_Core_Time::TimeToStamp ($ee['start_Time']);
                
                foreach ($io as $ee)
                    if ($ee['recordType']=="Exit")
                        $outTime += Fmc_Core_Time::TimeToStamp ($ee['start_Time']);
                
                foreach ($w as $work)
                {
                    $outTime += Fmc_Core_Time::TimeToStamp ($work['start_Time']);
                    $inTime += Fmc_Core_Time::TimeToStamp ($work['end_Time']);
                }
                
                if ($outTime-$inTime !=0) $err = "Your work hours and entrance/exit does not sum up.";
            }
        
        $user = sfContext::getInstance()->getUser();
        if ($errorRow) $user->setFlash('errorRow', $errorRow);
        
        return $err;
    }
    
    
}
