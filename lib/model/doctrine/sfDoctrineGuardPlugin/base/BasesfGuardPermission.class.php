<?php

/**
 * BasesfGuardPermission
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property string $name
 * @property string $description
 * @property Doctrine_Collection $Users
 * @property Doctrine_Collection $sfGuardUserPermission
 * 
 * @method string              getName()                  Returns the current record's "name" value
 * @method string              getDescription()           Returns the current record's "description" value
 * @method Doctrine_Collection getUsers()                 Returns the current record's "Users" collection
 * @method Doctrine_Collection getSfGuardUserPermission() Returns the current record's "sfGuardUserPermission" collection
 * @method sfGuardPermission   setName()                  Sets the current record's "name" value
 * @method sfGuardPermission   setDescription()           Sets the current record's "description" value
 * @method sfGuardPermission   setUsers()                 Sets the current record's "Users" collection
 * @method sfGuardPermission   setSfGuardUserPermission() Sets the current record's "sfGuardUserPermission" collection
 * 
 * @package    fmc
 * @subpackage model
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BasesfGuardPermission extends MyDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('sf_guard_permission');
        $this->hasColumn('name', 'string', 255, array(
             'type' => 'string',
             'unique' => true,
             'length' => 255,
             ));
        $this->hasColumn('description', 'string', 1000, array(
             'type' => 'string',
             'length' => 1000,
             ));

        $this->option('orderBy', 'name ASC');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('sfGuardUser as Users', array(
             'refClass' => 'sfGuardUserPermission',
             'local' => 'permission_id',
             'foreign' => 'user_id'));

        $this->hasMany('sfGuardUserPermission', array(
             'local' => 'id',
             'foreign' => 'permission_id'));

        $auditable0 = new Doctrine_Template_Auditable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $versionable0 = new Doctrine_Template_Versionable();
        $this->actAs($auditable0);
        $this->actAs($softdelete0);
        $this->actAs($versionable0);
    }
}