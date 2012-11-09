<?php

/**
 * BaseVat
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 * 
 * @property integer $rate
 * @property boolean $isDefault
 * @property boolean $isActive
 * @property Doctrine_Collection $CostFormItems
 * 
 * @method integer             getRate()          Returns the current record's "rate" value
 * @method boolean             getIsDefault()     Returns the current record's "isDefault" value
 * @method boolean             getIsActive()      Returns the current record's "isActive" value
 * @method Doctrine_Collection getCostFormItems() Returns the current record's "CostFormItems" collection
 * @method Vat                 setRate()          Sets the current record's "rate" value
 * @method Vat                 setIsDefault()     Sets the current record's "isDefault" value
 * @method Vat                 setIsActive()      Sets the current record's "isActive" value
 * @method Vat                 setCostFormItems() Sets the current record's "CostFormItems" collection
 * 
 * @package    fmc
 * @subpackage model
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: Builder.php 7490 2010-03-29 19:53:27Z jwage $
 */
abstract class BaseVat extends MyDoctrineRecord
{
    public function setTableDefinition()
    {
        $this->setTableName('vat');
        $this->hasColumn('rate', 'integer', null, array(
             'type' => 'integer',
             'notnull' => true,
             'unique' => true,
             ));
        $this->hasColumn('isDefault', 'boolean', null, array(
             'type' => 'boolean',
             'default' => false,
             ));
        $this->hasColumn('isActive', 'boolean', null, array(
             'type' => 'boolean',
             'default' => true,
             'notnull' => true,
             ));

        $this->option('orderBy', 'rate ASC');
    }

    public function setUp()
    {
        parent::setUp();
        $this->hasMany('CostFormItem as CostFormItems', array(
             'local' => 'id',
             'foreign' => 'vat_id'));

        $auditable0 = new Doctrine_Template_Auditable();
        $softdelete0 = new Doctrine_Template_SoftDelete();
        $versionable0 = new Doctrine_Template_Versionable();
        $this->actAs($auditable0);
        $this->actAs($softdelete0);
        $this->actAs($versionable0);
    }
}