<?php

/**
 * BaseWorkingHourEntranceExit
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $day_id
 * @property enum $type
 * @property time $time
 * @property WorkingHourDay $Day
 * 
 * @method integer                 getDayId()  Returns the current record's "day_id" value
 * @method enum                    getType()   Returns the current record's "type" value
 * @method time                    getTime()   Returns the current record's "time" value
 * @method WorkingHourDay          getDay()    Returns the current record's "Day" value
 * @method WorkingHourEntranceExit setDayId()  Sets the current record's "day_id" value
 * @method WorkingHourEntranceExit setType()   Sets the current record's "type" value
 * @method WorkingHourEntranceExit setTime()   Sets the current record's "time" value
 * @method WorkingHourEntranceExit setDay()    Sets the current record's "Day" value
 * 
 * @package    fmc
 * @subpackage model
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseWorkingHourEntranceExit extends MyDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('working_hour_entrance_exit');
        $this->hasColumn('day_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('type', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'Entrance',
              1 => 'Exit',
             ),
             'default' => 'Entrance',
             'notnull' => true,
             ));
        $this->hasColumn('time', 'time', null, array(
             'type' => 'time',
             'notnull' => true,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('WorkingHourDay as Day', array(
             'local' => 'day_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $auditable0 = new Doctrine_Template_Auditable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $versionable0 = new Doctrine_Template_Versionable();
        $this->actAs($auditable0);
        $this->actAs($softdelete0);
        $this->actAs($versionable0);
    }
}