<?php

/**
 * BaseWorkingHourWorkType
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property Doctrine_Collection $Departments
 * @property Doctrine_Collection $Employees
 * @property Doctrine_Collection $Department
 * @property Doctrine_Collection $DefaultWorkTypeEmployees
 * @property Doctrine_Collection $WorkingHourWorkTypeUser
 * @property Doctrine_Collection $WorkingHourWorkTypeGroup
 * @property Doctrine_Collection $WorkingHourRecords
 * 
 * @method string              getName()                     Returns the current record's "name" value
 * @method Doctrine_Collection getDepartments()              Returns the current record's "Departments" collection
 * @method Doctrine_Collection getEmployees()                Returns the current record's "Employees" collection
 * @method Doctrine_Collection getDepartment()               Returns the current record's "Department" collection
 * @method Doctrine_Collection getDefaultWorkTypeEmployees() Returns the current record's "DefaultWorkTypeEmployees" collection
 * @method Doctrine_Collection getWorkingHourWorkTypeUser()  Returns the current record's "WorkingHourWorkTypeUser" collection
 * @method Doctrine_Collection getWorkingHourWorkTypeGroup() Returns the current record's "WorkingHourWorkTypeGroup" collection
 * @method Doctrine_Collection getWorkingHourRecords()       Returns the current record's "WorkingHourRecords" collection
 * @method WorkingHourWorkType setName()                     Sets the current record's "name" value
 * @method WorkingHourWorkType setDepartments()              Sets the current record's "Departments" collection
 * @method WorkingHourWorkType setEmployees()                Sets the current record's "Employees" collection
 * @method WorkingHourWorkType setDepartment()               Sets the current record's "Department" collection
 * @method WorkingHourWorkType setDefaultWorkTypeEmployees() Sets the current record's "DefaultWorkTypeEmployees" collection
 * @method WorkingHourWorkType setWorkingHourWorkTypeUser()  Sets the current record's "WorkingHourWorkTypeUser" collection
 * @method WorkingHourWorkType setWorkingHourWorkTypeGroup() Sets the current record's "WorkingHourWorkTypeGroup" collection
 * @method WorkingHourWorkType setWorkingHourRecords()       Sets the current record's "WorkingHourRecords" collection
 * 
 * @package    fmc
 * @subpackage model
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseWorkingHourWorkType extends MyDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('working_hour_work_type');
        $this->hasColumn('name', 'string', 50, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 50,
             ));

        $this->option('orderBy', 'name ASC');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('sfGuardGroup as Departments', array(
             'refClass' => 'WorkingHourWorkTypeGroup',
             'local' => 'worktype_id',
             'foreign' => 'group_id'));

        $this->hasMany('sfGuardUser as Employees', array(
             'refClass' => 'WorkingHourWorkTypeUser',
             'local' => 'worktype_id',
             'foreign' => 'employee_id'));

        $this->hasMany('sfGuardGroup as Department', array(
             'local' => 'id',
             'foreign' => 'default_Worktype_id'));

        $this->hasMany('sfGuardUser as DefaultWorkTypeEmployees', array(
             'local' => 'id',
             'foreign' => 'default_Work_Type_id'));

        $this->hasMany('WorkingHourWorkTypeUser', array(
             'local' => 'id',
             'foreign' => 'worktype_id'));

        $this->hasMany('WorkingHourWorkTypeGroup', array(
             'local' => 'id',
             'foreign' => 'worktype_id'));

        $this->hasMany('WorkingHourRecord as WorkingHourRecords', array(
             'local' => 'id',
             'foreign' => 'work_Type_id'));

        $auditable0 = new Doctrine_Template_Auditable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $versionable0 = new Doctrine_Template_Versionable();
        $this->actAs($auditable0);
        $this->actAs($softdelete0);
        $this->actAs($versionable0);
    }
}