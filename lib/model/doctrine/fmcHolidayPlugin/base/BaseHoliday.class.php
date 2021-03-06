<?php

/**
 * BaseHoliday
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property date $day
 * @property string $name
 * @property enum $holiday_type
 * 
 * @method date    getDay()          Returns the current record's "day" value
 * @method string  getName()         Returns the current record's "name" value
 * @method enum    getHolidayType()  Returns the current record's "holiday_type" value
 * @method Holiday setDay()          Sets the current record's "day" value
 * @method Holiday setName()         Sets the current record's "name" value
 * @method Holiday setHolidayType()  Sets the current record's "holiday_type" value
 * 
 * @package    fmc
 * @subpackage model
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseHoliday extends MyDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('holiday');
        $this->hasColumn('day', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             'unique' => true,
             ));
        $this->hasColumn('name', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 50,
             ));
        $this->hasColumn('holiday_type', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'Half-day',
              1 => 'Full-day',
             ),
             'default' => 'Full-day',
             'notnull' => true,
             ));

        $this->option('orderBy', 'day ASC');
        $this->option('symfony', array(
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $auditable0 = new Doctrine_Template_Auditable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $versionable0 = new Doctrine_Template_Versionable();
        $this->actAs($auditable0);
        $this->actAs($softdelete0);
        $this->actAs($versionable0);
    }
}