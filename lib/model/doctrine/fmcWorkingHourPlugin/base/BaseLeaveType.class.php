<?php

/**
 * BaseLeaveType
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property boolean $has_Report
 * @property boolean $will_be_paid
 * @property Doctrine_Collection $LeaveRequest
 * 
 * @method string              getName()                       Returns the current record's "name" value
 * @method boolean             getHasReport()                  Returns the current record's "has_Report" value
 * @method boolean             getWillBePaid()                 Returns the current record's "will_be_paid" value
 * @method Doctrine_Collection getLeaveRequestEmployeeLimits() Returns the current record's "LeaveRequestEmployeeLimits" collection
 * @method Doctrine_Collection getWorkingHourParameter()       Returns the current record's "WorkingHourParameter" collection
 * @method Doctrine_Collection getLeaveRequest()               Returns the current record's "LeaveRequest" collection
 * @method LeaveType           setName()                       Sets the current record's "name" value
 * @method LeaveType           setHasReport()                  Sets the current record's "has_Report" value
 * @method LeaveType           setWillBePaid()                 Sets the current record's "will_be_paid" value
 * @method LeaveType           setLeaveRequestEmployeeLimits() Sets the current record's "LeaveRequestEmployeeLimits" collection
 * @method LeaveType           setWorkingHourParameter()       Sets the current record's "WorkingHourParameter" collection
 * @method LeaveType           setLeaveRequest()               Sets the current record's "LeaveRequest" collectionEmployeeLimits
 * @property Doctrine_Collection $WorkingHourParameter
 * @property Doctrine_Collection $LeaveRequest
 * 
 * @method string              getName()                       Returns the current record's "name" value
 * @method boolean             getHasReport()                  Returns the current record's "has_Report" value
 * @method boolean             getWillBePaid()                 Returns the current record's "will_be_paid" value
 * @method Doctrine_Collection getLeaveRequestEmployeeLimits() Returns the current record's "LeaveRequestEmployeeLimits" collection
 * @method Doctrine_Collection getWorkingHourParameter()       Returns the current record's "WorkingHourParameter" collection
 * @method Doctrine_Collection getLeaveRequest()               Returns the current record's "LeaveRequest" collection
 * @method LeaveType           setName()                       Sets the current record's "name" value
 * @method LeaveType           setHasReport()                  Sets the current record's "has_Report" value
 * @method LeaveType           setWillBePaid()                 Sets the current record's "will_be_paid" value
 * @method LeaveType           setLeaveRequestEmployeeLimits() Sets the current record's "LeaveRequestEmployeeLimits" collection
 * @method LeaveType           setWorkingHourParameter()       Sets the current record's "WorkingHourParameter" collection
 * @method LeaveType           setLeaveRequest()               Sets the current record's "LeaveRequest" collection
 * 
 * @package    fmc
 * @subpackage model
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseLeaveType extends MyDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('leave_type');
        $this->hasColumn('name', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 50,
             ));
        $this->hasColumn('has_Report', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => false,
             ));
        $this->hasColumn('will_be_paid', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => true,
             ));

        $this->option('orderBy', 'name ASC');
        $this->option('symfony', array(
             'filter' => false,
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('LeaveRequestEmployeeLimit as LeaveRequestEmployeeLimits', array(
             'local' => 'id',
             'foreign' => 'type_id'));

        $this->hasMany('WorkingHourParameter', array(
             'local' => 'id',
             'foreign' => 'value_leavetype_id'));

        $this->hasMany('LeaveRequest', array(
             'local' => 'id',
             'foreign' => 'type_id'));

        $auditable0 = new Doctrine_Template_Auditable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $versionable0 = new Doctrine_Template_Versionable();
        $this->actAs($auditable0);
        $this->actAs($softdelete0);
        $this->actAs($versionable0);
    }
}