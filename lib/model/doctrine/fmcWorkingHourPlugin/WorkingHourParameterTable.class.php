<?php

/**
 * WorkingHourParameterTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class WorkingHourParameterTable extends PluginWorkingHourParameterTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object WorkingHourParameterTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('WorkingHourParameter');
    }
}