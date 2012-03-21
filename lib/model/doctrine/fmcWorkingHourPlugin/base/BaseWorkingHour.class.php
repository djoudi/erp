<?php

/**
 * BaseWorkingHour
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $user_id
 * @property date $date
 * @property integer $project_id
 * @property integer $worktype_id
 * @property string $comment
 * @property time $start
 * @property time $end
 * @property integer $created_by
 * @property integer $updated_by
 * @property sfGuardUser $User
 * @property Project $Project
 * @property WorkType $WorkType
 * @property sfGuardUser $Creator
 * @property sfGuardUser $Updater
 * 
 * @method integer     getUserId()      Returns the current record's "user_id" value
 * @method date        getDate()        Returns the current record's "date" value
 * @method integer     getProjectId()   Returns the current record's "project_id" value
 * @method integer     getWorktypeId()  Returns the current record's "worktype_id" value
 * @method string      getComment()     Returns the current record's "comment" value
 * @method time        getStart()       Returns the current record's "start" value
 * @method time        getEnd()         Returns the current record's "end" value
 * @method integer     getCreatedBy()   Returns the current record's "created_by" value
 * @method integer     getUpdatedBy()   Returns the current record's "updated_by" value
 * @method sfGuardUser getUser()        Returns the current record's "User" value
 * @method Project     getProject()     Returns the current record's "Project" value
 * @method WorkType    getWorkType()    Returns the current record's "WorkType" value
 * @method sfGuardUser getCreator()     Returns the current record's "Creator" value
 * @method sfGuardUser getUpdater()     Returns the current record's "Updater" value
 * @method WorkingHour setUserId()      Sets the current record's "user_id" value
 * @method WorkingHour setDate()        Sets the current record's "date" value
 * @method WorkingHour setProjectId()   Sets the current record's "project_id" value
 * @method WorkingHour setWorktypeId()  Sets the current record's "worktype_id" value
 * @method WorkingHour setComment()     Sets the current record's "comment" value
 * @method WorkingHour setStart()       Sets the current record's "start" value
 * @method WorkingHour setEnd()         Sets the current record's "end" value
 * @method WorkingHour setCreatedBy()   Sets the current record's "created_by" value
 * @method WorkingHour setUpdatedBy()   Sets the current record's "updated_by" value
 * @method WorkingHour setUser()        Sets the current record's "User" value
 * @method WorkingHour setProject()     Sets the current record's "Project" value
 * @method WorkingHour setWorkType()    Sets the current record's "WorkType" value
 * @method WorkingHour setCreator()     Sets the current record's "Creator" value
 * @method WorkingHour setUpdater()     Sets the current record's "Updater" value
 * 
 * @package    fmc
 * @subpackage model
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseWorkingHour extends sfDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('working_hour');
        $this->hasColumn('user_id', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('date', 'date', null, array(
             'type' => 'date',
             ));
        $this->hasColumn('project_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('worktype_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('comment', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));
        $this->hasColumn('start', 'time', null, array(
             'type' => 'time',
             'notnull' => true,
             ));
        $this->hasColumn('end', 'time', null, array(
             'type' => 'time',
             'notnull' => true,
             ));
        $this->hasColumn('created_by', 'integer', null, array(
             'type' => 'integer',
             ));
        $this->hasColumn('updated_by', 'integer', null, array(
             'type' => 'integer',
             ));
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('sfGuardUser as User', array(
             'local' => 'user_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('Project', array(
             'local' => 'project_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasOne('WorkType', array(
             'local' => 'worktype_id',
             'foreign' => 'id'));

        $this->hasOne('sfGuardUser as Creator', array(
             'local' => 'created_by',
             'foreign' => 'id'));

        $this->hasOne('sfGuardUser as Updater', array(
             'local' => 'updated_by',
             'foreign' => 'id'));

        $softdelete0 = new Doctrine_Template_SoftDelete();
        $timestampable0 = new Doctrine_Template_Timestampable();
        $versionable0 = new Doctrine_Template_Versionable();
        $this->actAs($softdelete0);
        $this->actAs($timestampable0);
        $this->actAs($versionable0);
    }
}