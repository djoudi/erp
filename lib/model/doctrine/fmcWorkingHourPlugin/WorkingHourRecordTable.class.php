<?php

/**
 * WorkingHourRecordTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class WorkingHourRecordTable extends PluginWorkingHourRecordTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object WorkingHourRecordTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('WorkingHourRecord');
    }
}