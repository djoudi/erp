<?php

/**
 * WorkingHourWorkTypeTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class WorkingHourWorkTypeTable extends PluginWorkingHourWorkTypeTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object WorkingHourWorkTypeTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('WorkingHourWorkType');
    }
}