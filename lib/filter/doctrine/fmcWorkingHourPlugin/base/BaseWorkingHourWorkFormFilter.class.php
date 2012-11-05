<?php

/**
 * WorkingHourWork filter form base class.
 *
 * @package    fmc
 * @subpackage filter
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseWorkingHourWorkFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'day_id'     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Day'), 'add_empty' => true)),
      'type_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('WorkType'), 'add_empty' => true)),
      'start'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'end'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'comment'    => new sfWidgetFormFilterInput(),
      'creater_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updater_id' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'version'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'day_id'     => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Day'), 'column' => 'id')),
      'type_id'    => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('WorkType'), 'column' => 'id')),
      'start'      => new sfValidatorPass(array('required' => false)),
      'end'        => new sfValidatorPass(array('required' => false)),
      'comment'    => new sfValidatorPass(array('required' => false)),
      'creater_id' => new sfValidatorPass(array('required' => false)),
      'updater_id' => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'version'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('working_hour_work_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkingHourWork';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'day_id'     => 'ForeignKey',
      'type_id'    => 'ForeignKey',
      'start'      => 'Text',
      'end'        => 'Text',
      'comment'    => 'Text',
      'creater_id' => 'Text',
      'updater_id' => 'Text',
      'created_at' => 'Date',
      'updated_at' => 'Date',
      'deleted_at' => 'Date',
      'version'    => 'Number',
    );
  }
}
