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
}
