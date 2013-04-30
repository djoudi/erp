<?php

/**
 * BasesfGuardUser
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $first_name
 * @property string $last_name
 * @property string $title
 * @property string $email_address
 * @property string $username
 * @property string $algorithm
 * @property string $salt
 * @property string $password
 * @property boolean $is_active
 * @property boolean $is_super_admin
 * @property timestamp $last_login
 * @property integer $group_id
 * @property integer $required_daily_work_minutes
 * @property integer $required_daily_break_minutes
 * @property date $employment_start
 * @property date $employment_end
 * @property time $office_Entrance
 * @property time $office_Exit
 * @property integer $default_Work_Type_id
 * @property integer $monthly_Working_Hours
 * @property boolean $send_Email
 * @property sfGuardGroup $Department
 * @property Doctrine_Collection $Permissions
 * @property WorkingHourWorkType $DefaultWorkType
 * @property Doctrine_Collection $WorkTypes
 * @property Doctrine_Collection $sfGuardUserPermission
 * @property sfGuardRememberKey $RememberKeys
 * @property sfGuardForgotPassword $ForgotPassword
 * @property Doctrine_Collection $CostFormInvoicings
 * @property Doctrine_Collection $CostForms
 * @property Doctrine_Collection $CostFormItems
 * @property Doctrine_Collection $LeaveRequestEmployeeLimits
 * @property Doctrine_Collection $WorkingHourWorkTypeUser
 * @property Doctrine_Collection $LeaveRequest
 * @property Doctrine_Collection $WorkingHourDay
 * 
 * @method string                getFirstName()                    Returns the current record's "first_name" value
 * @method string                getLastName()                     Returns the current record's "last_name" value
 * @method string                getTitle()                        Returns the current record's "title" value
 * @method string                getEmailAddress()                 Returns the current record's "email_address" value
 * @method string                getUsername()                     Returns the current record's "username" value
 * @method string                getAlgorithm()                    Returns the current record's "algorithm" value
 * @method string                getSalt()                         Returns the current record's "salt" value
 * @method string                getPassword()                     Returns the current record's "password" value
 * @method boolean               getIsActive()                     Returns the current record's "is_active" value
 * @method boolean               getIsSuperAdmin()                 Returns the current record's "is_super_admin" value
 * @method timestamp             getLastLogin()                    Returns the current record's "last_login" value
 * @method integer               getGroupId()                      Returns the current record's "group_id" value
 * @method integer               getRequiredDailyWorkMinutes()     Returns the current record's "required_daily_work_minutes" value
 * @method integer               getRequiredDailyBreakMinutes()    Returns the current record's "required_daily_break_minutes" value
 * @method date                  getEmploymentStart()              Returns the current record's "employment_start" value
 * @method date                  getEmploymentEnd()                Returns the current record's "employment_end" value
 * @method time                  getOfficeEntrance()               Returns the current record's "office_Entrance" value
 * @method time                  getOfficeExit()                   Returns the current record's "office_Exit" value
 * @method integer               getDefaultWorkTypeId()            Returns the current record's "default_Work_Type_id" value
 * @method integer               getMonthlyWorkingHours()          Returns the current record's "monthly_Working_Hours" value
 * @method boolean               getSendEmail()                    Returns the current record's "send_Email" value
 * @method sfGuardGroup          getDepartment()                   Returns the current record's "Department" value
 * @method Doctrine_Collection   getPermissions()                  Returns the current record's "Permissions" collection
 * @method WorkingHourWorkType   getDefaultWorkType()              Returns the current record's "DefaultWorkType" value
 * @method Doctrine_Collection   getWorkTypes()                    Returns the current record's "WorkTypes" collection
 * @method Doctrine_Collection   getSfGuardUserPermission()        Returns the current record's "sfGuardUserPermission" collection
 * @method sfGuardRememberKey    getRememberKeys()                 Returns the current record's "RememberKeys" value
 * @method sfGuardForgotPassword getForgotPassword()               Returns the current record's "ForgotPassword" value
 * @method Doctrine_Collection   getCostFormInvoicings()           Returns the current record's "CostFormInvoicings" collection
 * @method Doctrine_Collection   getCostForms()                    Returns the current record's "CostForms" collection
 * @method Doctrine_Collection   getCostFormItems()                Returns the current record's "CostFormItems" collection
 * @method Doctrine_Collection   getLeaveRequestEmployeeLimits()   Returns the current record's "LeaveRequestEmployeeLimits" collection
 * @method Doctrine_Collection   getWorkingHourWorkTypeUser()      Returns the current record's "WorkingHourWorkTypeUser" collection
 * @method Doctrine_Collection   getLeaveRequest()                 Returns the current record's "LeaveRequest" collection
 * @method Doctrine_Collection   getWorkingHourDay()               Returns the current record's "WorkingHourDay" collection
 * @method sfGuardUser           setFirstName()                    Sets the current record's "first_name" value
 * @method sfGuardUser           setLastName()                     Sets the current record's "last_name" value
 * @method sfGuardUser           setTitle()                        Sets the current record's "title" value
 * @method sfGuardUser           setEmailAddress()                 Sets the current record's "email_address" value
 * @method sfGuardUser           setUsername()                     Sets the current record's "username" value
 * @method sfGuardUser           setAlgorithm()                    Sets the current record's "algorithm" value
 * @method sfGuardUser           setSalt()                         Sets the current record's "salt" value
 * @method sfGuardUser           setPassword()                     Sets the current record's "password" value
 * @method sfGuardUser           setIsActive()                     Sets the current record's "is_active" value
 * @method sfGuardUser           setIsSuperAdmin()                 Sets the current record's "is_super_admin" value
 * @method sfGuardUser           setLastLogin()                    Sets the current record's "last_login" value
 * @method sfGuardUser           setGroupId()                      Sets the current record's "group_id" value
 * @method sfGuardUser           setRequiredDailyWorkMinutes()     Sets the current record's "required_daily_work_minutes" value
 * @method sfGuardUser           setRequiredDailyBreakMinutes()    Sets the current record's "required_daily_break_minutes" value
 * @method sfGuardUser           setEmploymentStart()              Sets the current record's "employment_start" value
 * @method sfGuardUser           setEmploymentEnd()                Sets the current record's "employment_end" value
 * @method sfGuardUser           setOfficeEntrance()               Sets the current record's "office_Entrance" value
 * @method sfGuardUser           setOfficeExit()                   Sets the current record's "office_Exit" value
 * @method sfGuardUser           setDefaultWorkTypeId()            Sets the current record's "default_Work_Type_id" value
 * @method sfGuardUser           setMonthlyWorkingHours()          Sets the current record's "monthly_Working_Hours" value
 * @method sfGuardUser           setSendEmail()                    Sets the current record's "send_Email" value
 * @method sfGuardUser           setDepartment()                   Sets the current record's "Department" value
 * @method sfGuardUser           setPermissions()                  Sets the current record's "Permissions" collection
 * @method sfGuardUser           setDefaultWorkType()              Sets the current record's "DefaultWorkType" value
 * @method sfGuardUser           setWorkTypes()                    Sets the current record's "WorkTypes" collection
 * @method sfGuardUser           setSfGuardUserPermission()        Sets the current record's "sfGuardUserPermission" collection
 * @method sfGuardUser           setRememberKeys()                 Sets the current record's "RememberKeys" value
 * @method sfGuardUser           setForgotPassword()               Sets the current record's "ForgotPassword" value
 * @method sfGuardUser           setCostFormInvoicings()           Sets the current record's "CostFormInvoicings" collection
 * @method sfGuardUser           setCostForms()                    Sets the current record's "CostForms" collection
 * @method sfGuardUser           setCostFormItems()                Sets the current record's "CostFormItems" collection
 * @method sfGuardUser           setLeaveRequestEmployeeLimits()   Sets the current record's "LeaveRequestEmployeeLimits" collection
 * @method sfGuardUser           setWorkingHourWorkTypeUser()      Sets the current record's "WorkingHourWorkTypeUser" collection
 * @method sfGuardUser           setLeaveRequest()                 Sets the current record's "LeaveRequest" collection
 * @method sfGuardUser           setWorkingHourDay()               Sets the current record's "WorkingHourDay" collection
 * 
 * @package    fmc
 * @subpackage model
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasesfGuardUser extends MyDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_guard_user');
        $this->hasColumn('first_name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('last_name', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'length' => 255,
             ));
        $this->hasColumn('title', 'string', 255, array(
             'type' => 'string',
             'length' => 255,
             ));
        $this->hasColumn('email_address', 'string', 255, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 255,
             ));
        $this->hasColumn('username', 'string', 128, array(
             'type' => 'string',
             'notnull' => true,
             'unique' => true,
             'length' => 128,
             ));
        $this->hasColumn('algorithm', 'string', 128, array(
             'type' => 'string',
             'default' => 'sha1',
             'notnull' => true,
             'length' => 128,
             ));
        $this->hasColumn('salt', 'string', 128, array(
             'type' => 'string',
             'length' => 128,
             ));
        $this->hasColumn('password', 'string', 128, array(
             'type' => 'string',
             'length' => 128,
             ));
        $this->hasColumn('is_active', 'boolean', null, array(
             'type' => 'boolean',
             'default' => 1,
             ));
        $this->hasColumn('is_super_admin', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('last_login', 'timestamp', null, array(
             'type' => 'timestamp',
             ));
        $this->hasColumn('group_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('required_daily_work_minutes', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('required_daily_break_minutes', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('employment_start', 'date', null, array(
             'type' => 'date',
             'notnull' => false,
             ));
        $this->hasColumn('employment_end', 'date', null, array(
             'type' => 'date',
             'notnull' => false,
             ));
        $this->hasColumn('office_Entrance', 'time', null, array(
             'type' => 'time',
             'notnull' => false,
             ));
        $this->hasColumn('office_Exit', 'time', null, array(
             'type' => 'time',
             'notnull' => false,
             ));
        $this->hasColumn('default_Work_Type_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('monthly_Working_Hours', 'integer', null, array(
             'type' => 'integer',
             'notnull' => false,
             ));
        $this->hasColumn('send_Email', 'boolean', null, array(
             'type' => 'boolean',
             'notnull' => true,
             'default' => false,
             ));


        $this->index('is_active_idx', array(
             'fields' => 
             array(
              0 => 'is_active',
             ),
             ));
        $this->option('orderBy', 'first_name ASC, last_name ASC');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardGroup as Department', array(
             'local' => 'group_id',
             'foreign' => 'id'));

        $this->hasMany('sfGuardPermission as Permissions', array(
             'refClass' => 'sfGuardUserPermission',
             'local' => 'user_id',
             'foreign' => 'permission_id'));

        $this->hasOne('WorkingHourWorkType as DefaultWorkType', array(
             'local' => 'default_Work_Type_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('WorkingHourWorkType as WorkTypes', array(
             'refClass' => 'WorkingHourWorkTypeUser',
             'local' => 'employee_id',
             'foreign' => 'worktype_id'));

        $this->hasMany('sfGuardUserPermission', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasOne('sfGuardRememberKey as RememberKeys', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasOne('sfGuardForgotPassword as ForgotPassword', array(
             'local' => 'id',
             'foreign' => 'user_id'));

        $this->hasMany('CostFormInvoicing as CostFormInvoicings', array(
             'local' => 'id',
             'foreign' => 'employee_id'));

        $this->hasMany('CostForm as CostForms', array(
             'local' => 'id',
             'foreign' => 'employee_id'));

        $this->hasMany('CostFormItem as CostFormItems', array(
             'local' => 'id',
             'foreign' => 'invoiced_By'));

        $this->hasMany('LeaveRequestEmployeeLimit as LeaveRequestEmployeeLimits', array(
             'local' => 'id',
             'foreign' => 'employee_id'));

        $this->hasMany('WorkingHourWorkTypeUser', array(
             'local' => 'id',
             'foreign' => 'employee_id'));

        $this->hasMany('LeaveRequest', array(
             'local' => 'id',
             'foreign' => 'employee_id'));

        $this->hasMany('WorkingHourDay', array(
             'local' => 'id',
             'foreign' => 'employee_id'));

        $auditable0 = new Doctrine_Template_Auditable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $versionable0 = new Doctrine_Template_Versionable();
        $this->actAs($auditable0);
        $this->actAs($softdelete0);
        $this->actAs($versionable0);
    }
}