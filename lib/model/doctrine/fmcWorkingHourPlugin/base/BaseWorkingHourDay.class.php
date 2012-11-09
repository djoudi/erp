<?php

/**
 * BaseWorkingHourDay
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property integer $leave_id
 * @property date $date
 * @property enum $status
 * @property decimal $multiplier
 * @property sfGuardUser $Employee
 * @property LeaveRequest $LeaveRequest
 * @property Doctrine_Collection $WorkingHourEntranceExit
 * @property Doctrine_Collection $WorkingHourWork
 * 
 * @method integer             getUserId()                  Returns the current record's "user_id" value
 * @method integer             getLeaveId()                 Returns the current record's "leave_id" value
 * @method date                getDate()                    Returns the current record's "date" value
 * @method enum                getStatus()                  Returns the current record's "status" value
 * @method decimal             getMultiplier()              Returns the current record's "multiplier" value
 * @method sfGuardUser         getEmployee()                Returns the current record's "Employee" value
 * @method LeaveRequest        getLeaveRequest()            Returns the current record's "LeaveRequest" value
 * @method Doctrine_Collection getWorkingHourEntranceExit() Returns the current record's "WorkingHourEntranceExit" collection
 * @method Doctrine_Collection getWorkingHourWork()         Returns the current record's "WorkingHourWork" collection
 * @method WorkingHourDay      setUserId()                  Sets the current record's "user_id" value
 * @method WorkingHourDay      setLeaveId()                 Sets the current record's "leave_id" value
 * @method WorkingHourDay      setDate()                    Sets the current record's "date" value
 * @method WorkingHourDay      setStatus()                  Sets the current record's "status" value
 * @method WorkingHourDay      setMultiplier()              Sets the current record's "multiplier" value
 * @method WorkingHourDay      setEmployee()                Sets the current record's "Employee" value
 * @method WorkingHourDay      setLeaveRequest()            Sets the current record's "LeaveRequest" value
 * @method WorkingHourDay      setWorkingHourEntranceExit() Sets the current record's "WorkingHourEntranceExit" collection
 * @method WorkingHourDay      setWorkingHourWork()         Sets the current record's "WorkingHourWork" collection
 * 
 * @package    fmc
 * @subpackage model
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseWorkingHourDay extends MyDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('working_hour_day');
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('leave_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('date', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('status', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'Draft',
              1 => 'Pending',
              2 => 'Accepted',
              3 => 'Denied',
             ),
             'default' => 'Draft',
             'notnull' => true,
             ));
        $this->hasColumn('multiplier', 'decimal', null, array(
             'type' => 'decimal',
             'notnull' => true,
             'default' => 1,
             ));

        $this->option('orderBy', 'date ASC');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as Employee', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('LeaveRequest', array(
             'local' => 'leave_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('WorkingHourEntranceExit', array(
             'local' => 'id',
             'foreign' => 'day_id'));

        $this->hasMany('WorkingHourWork', array(
             'local' => 'id',
             'foreign' => 'day_id'));

        $auditable0 = new Doctrine_Template_Auditable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $versionable0 = new Doctrine_Template_Versionable();
        $this->actAs($auditable0);
        $this->actAs($softdelete0);
        $this->actAs($versionable0);
    }
}