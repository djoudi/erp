<?php

abstract class PluginWorkingHourDay extends BaseWorkingHourDay
{
    public function getActiveIORecords()
    {
        $result = Doctrine::getTable ('WorkingHourEntranceExit')
            ->createQuery ('io')
            ->addWhere ('day_id = ?', $this->id)
            ->orderBy ('time ASC')
            ->execute();
        return $result;
    }
}
