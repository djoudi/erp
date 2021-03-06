<?php

/**
 * sfGuardGroup filter form base class.
 *
 * @package    fmc
 * @subpackage filter
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfGuardGroupFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                => new sfWidgetFormFilterInput(),
      'description'         => new sfWidgetFormFilterInput(),
      'manager_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Manager'), 'add_empty' => true)),
      'default_Worktype_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Default_Work_Type'), 'add_empty' => true)),
      'creater_id'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updater_id'          => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'version'             => new sfWidgetFormFilterInput(),
      'work_types_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'WorkingHourWorkType')),
    ));

    $this->setValidators(array(
      'name'                => new sfValidatorPass(array('required' => false)),
      'description'         => new sfValidatorPass(array('required' => false)),
      'manager_id'          => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Manager'), 'column' => 'id')),
      'default_Worktype_id' => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Default_Work_Type'), 'column' => 'id')),
      'creater_id'          => new sfValidatorPass(array('required' => false)),
      'updater_id'          => new sfValidatorPass(array('required' => false)),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'version'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'work_types_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'WorkingHourWorkType', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_group_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addWorkTypesListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.WorkingHourWorkTypeGroup WorkingHourWorkTypeGroup')
      ->andWhereIn('WorkingHourWorkTypeGroup.worktype_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'sfGuardGroup';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'name'                => 'Text',
      'description'         => 'Text',
      'manager_id'          => 'ForeignKey',
      'default_Worktype_id' => 'ForeignKey',
      'creater_id'          => 'Text',
      'updater_id'          => 'Text',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
      'deleted_at'          => 'Date',
      'version'             => 'Number',
      'work_types_list'     => 'ManyKey',
    );
  }
}
