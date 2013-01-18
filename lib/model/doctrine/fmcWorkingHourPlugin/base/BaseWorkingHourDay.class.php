<?php

/**
 * BaseWorkingHourDay
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $employee_id
 * @property date $date
 * @property enum $status
 * @property integer $leave_id
 * @property decimal $multiplier
 * @property integer $daily_Breaks
 * @property sfGuardUser $Employee
 * @property LeaveRequest $LeaveRequest
 * @property Doctrine_Collection $WorkingHourRecords
 * 
 * @method integer             getEmployeeId()         Returns the current record's "employee_id" value
 * @method date                getDate()               Returns the current record's "date" value
 * @method enum                getStatus()             Returns the current record's "status" value
 * @method integer             getLeaveId()            Returns the current record's "leave_id" value
 * @method decimal             getMultiplier()         Returns the current record's "multiplier" value
 * @method integer             getDailyBreaks()        Returns the current record's "daily_Breaks" value
 * @method sfGuardUser         getEmployee()           Returns the current record's "Employee" value
 * @method LeaveRequest        getLeaveRequest()       Returns the current record's "LeaveRequest" value
 * @method Doctrine_Collection getWorkingHourRecords() Returns the current record's "WorkingHourRecords" collection
 * @method WorkingHourDay      setEmployeeId()         Sets the current record's "employee_id" value
 * @method WorkingHourDay      setDate()               Sets the current record's "date" value
 * @method WorkingHourDay      setStatus()             Sets the current record's "status" value
 * @method WorkingHourDay      setLeaveId()            Sets the current record's "leave_id" value
 * @method WorkingHourDay      setMultiplier()         Sets the current record's "multiplier" value
 * @method WorkingHourDay      setDailyBreaks()        Sets the current record's "daily_Breaks" value
 * @method WorkingHourDay      setEmployee()           Sets the current record's "Employee" value
 * @method WorkingHourDay      setLeaveRequest()       Sets the current record's "LeaveRequest" value
 * @method WorkingHourDay      setWorkingHourRecords() Sets the current record's "WorkingHourRecords" collection
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
        $this->hasColumn('employee_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
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
        $this->hasColumn('leave_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('multiplier', 'decimal', null, array(
             'type' => 'decimal',
             'scale' => 4,
             'notnull' => true,
             'default' => 1,
             ));
        $this->hasColumn('daily_Breaks', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));

        $this->option('orderBy', 'date DESC');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as Employee', array(
             'local' => 'employee_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('LeaveRequest', array(
             'local' => 'leave_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('WorkingHourRecord as WorkingHourRecords', array(
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