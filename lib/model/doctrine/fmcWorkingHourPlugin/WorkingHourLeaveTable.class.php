<?php

/**
 * WorkingHourLeaveTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class WorkingHourLeaveTable extends PluginWorkingHourLeaveTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object WorkingHourLeaveTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('WorkingHourLeave');
    }
}