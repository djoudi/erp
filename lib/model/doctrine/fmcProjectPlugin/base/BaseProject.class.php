<?php

/**
 * BaseProject
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $customer_id
 * @property enum $status
 * @property string $code
 * @property string $title
 * @property string $description
 * @property Customer $Customers
 * @property Doctrine_Collection $CostForms
 * @property Doctrine_Collection $WorkingHourRecords
 * 
 * @method integer             getCustomerId()         Returns the current record's "customer_id" value
 * @method enum                getStatus()             Returns the current record's "status" value
 * @method string              getCode()               Returns the current record's "code" value
 * @method string              getTitle()              Returns the current record's "title" value
 * @method string              getDescription()        Returns the current record's "description" value
 * @method Customer            getCustomers()          Returns the current record's "Customers" value
 * @method Doctrine_Collection getCostForms()          Returns the current record's "CostForms" collection
 * @method Doctrine_Collection getWorkingHourRecords() Returns the current record's "WorkingHourRecords" collection
 * @method Project             setCustomerId()         Sets the current record's "customer_id" value
 * @method Project             setStatus()             Sets the current record's "status" value
 * @method Project             setCode()               Sets the current record's "code" value
 * @method Project             setTitle()              Sets the current record's "title" value
 * @method Project             setDescription()        Sets the current record's "description" value
 * @method Project             setCustomers()          Sets the current record's "Customers" value
 * @method Project             setCostForms()          Sets the current record's "CostForms" collection
 * @method Project             setWorkingHourRecords() Sets the current record's "WorkingHourRecords" collection
 * 
 * @package    fmc
 * @subpackage model
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseProject extends MyDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('project');
        $this->hasColumn('customer_id', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             ));
        $this->hasColumn('status', 'enum', null, array(
             'type' => 'enum',
             'values' => 
             array(
              0 => 'Active',
              1 => 'Passive',
             ),
             'default' => 'Active',
             'notnull' => true,
             ));
        $this->hasColumn('code', 'string', 20, array(
             'type' => 'string',
             'unique' => true,
             'notnull' => true,
             'length' => 20,
             ));
        $this->hasColumn('title', 'string', 150, array(
             'type' => 'string',
             'length' => 150,
             ));
        $this->hasColumn('description', 'string', 250, array(
             'type' => 'string',
             'length' => 250,
             ));

        $this->option('orderBy', 'code ASC');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasOne('Customer as Customers', array(
             'local' => 'customer_id',
             'foreign' => 'id',
             'onDelete' => 'CASCADE'));

        $this->hasMany('CostForm as CostForms', array(
             'local' => 'id',
             'foreign' => 'project_id'));

        $this->hasMany('WorkingHourRecord as WorkingHourRecords', array(
             'local' => 'id',
             'foreign' => 'project_id'));

        $auditable0 = new Doctrine_Template_Auditable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $versionable0 = new Doctrine_Template_Versionable();
        $this->actAs($auditable0);
        $this->actAs($softdelete0);
        $this->actAs($versionable0);
    }
}