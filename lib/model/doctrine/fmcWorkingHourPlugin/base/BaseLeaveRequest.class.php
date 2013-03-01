<?php

/**
 * BaseLeaveRequest
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $employee_id
 * @property integer $type_id
 * @property enum $status
 * @property date $start_Date
 * @property date $end_Date
 * @property boolean $is_half_day
 * @property decimal $day_Count
 * @property string $comment
 * @property date $report_Date
 * @property string $report_Number
 * @property date $report_Received
 * @property sfGuardUser $Employee
 * @property LeaveType $LeaveType
 * @property Doctrine_Collection $WorkingHourDay
 * 
 * @method integer             getEmployeeId()      Returns the current record's "employee_id" value
 * @method integer             getTypeId()          Returns the current record's "type_id" value
 * @method enum                getStatus()          Returns the current record's "status" value
 * @method date                getStartDate()       Returns the current record's "start_Date" value
 * @method date                getEndDate()         Returns the current record's "end_Date" value
 * @method boolean             getIsHalfDay()       Returns the current record's "is_half_day" value
 * @method decimal             getDayCount()        Returns the current record's "day_Count" value
 * @method string              getComment()         Returns the current record's "comment" value
 * @method date                getReportDate()      Returns the current record's "report_Date" value
 * @method string              getReportNumber()    Returns the current record's "report_Number" value
 * @method date                getReportReceived()  Returns the current record's "report_Received" value
 * @method sfGuardUser         getEmployee()        Returns the current record's "Employee" value
 * @method LeaveType           getLeaveType()       Returns the current record's "LeaveType" value
 * @method Doctrine_Collection getWorkingHourDay()  Returns the current record's "WorkingHourDay" collection
 * @method LeaveRequest        setEmployeeId()      Sets the current record's "employee_id" value
 * @method LeaveRequest        setTypeId()          Sets the current record's "type_id" value
 * @method LeaveRequest        setStatus()          Sets the current record's "status" value
 * @method LeaveRequest        setStartDate()       Sets the current record's "start_Date" value
 * @method LeaveRequest        setEndDate()         Sets the current record's "end_Date" value
 * @method LeaveRequest        setIsHalfDay()       Sets the current record's "is_half_day" value
 * @method LeaveRequest        setDayCount()        Sets the current record's "day_Count" value
 * @method LeaveRequest        setComment()         Sets the current record's "comment" value
 * @method LeaveRequest        setReportDate()      Sets the current record's "report_Date" value
 * @method LeaveRequest        setReportNumber()    Sets the current record's "report_Number" value
 * @method LeaveRequest        setReportReceived()  Sets the current record's "report_Received" value
 * @method LeaveRequest        setEmployee()        Sets the current record's "Employee" value
 * @method LeaveRequest        setLeaveType()       Sets the current record's "LeaveType" value
 * @method LeaveRequest        setWorkingHourDay()  Sets the current record's "WorkingHourDay" collection
 * 
 * @package    fmc
 * @subpackage model
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLeaveRequest extends MyDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('leave_request');
        $this->hasColumn('employee_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('type_id', 'integer', null, array(
             'type' => 'integer',
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
        $this->hasColumn('start_Date', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('end_Date', 'date', null, array(
             'type' => 'date',
             'notnull' => true,
             ));
        $this->hasColumn('is_half_day', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             'notnull' => true,
             ));
        $this->hasColumn('day_Count', 'decimal', null, array(
             'type' => 'decimal',
             'scale' => 1,
             'notnull' => true,
             'default' => 0,
             ));
        $this->hasColumn('comment', 'string', 250, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 250,
             ));
        $this->hasColumn('report_Date', 'date', null, array(
             'type' => 'date',
             'notnull' => false,
             ));
        $this->hasColumn('report_Number', 'string', 50, array(
             'type' => 'string',
             'notnull' => false,
             'length' => 50,
             ));
        $this->hasColumn('report_Received', 'date', null, array(
             'type' => 'date',
             'notnull' => false,
             ));

        $this->option('orderBy', 'start_Date DESC');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as Employee', array(
             'local' => 'employee_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('LeaveType', array(
             'local' => 'type_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('WorkingHourDay', array(
             'local' => 'id',
             'foreign' => 'leave_id'));

        $auditable0 = new Doctrine_Template_Auditable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $versionable0 = new Doctrine_Template_Versionable();
        $this->actAs($auditable0);
        $this->actAs($softdelete0);
        $this->actAs($versionable0);
    }
}