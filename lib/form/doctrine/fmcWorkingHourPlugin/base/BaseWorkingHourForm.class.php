<?php

/**
 * WorkingHour form base class.
 *
 * @method WorkingHour getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWorkingHourForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'user_id'       => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Users'), 'add_empty' => true)),
      'date'          => new sfWidgetFormDate(),
      'project_id'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Projects'), 'add_empty' => false)),
      'worktype'      => new sfWidgetFormInputText(),
      'comment'       => new sfWidgetFormInputText(),
      'time_started'  => new sfWidgetFormTime(),
      'time_finished' => new sfWidgetFormTime(),
      'time'          => new sfWidgetFormTime(),
      'created_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'add_empty' => true)),
      'updated_by'    => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Updater'), 'add_empty' => true)),
      'deleted_at'    => new sfWidgetFormDateTime(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'version'       => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'       => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Users'), 'required' => false)),
      'date'          => new sfValidatorDate(array('required' => false)),
      'project_id'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Projects'))),
      'worktype'      => new sfValidatorInteger(),
      'comment'       => new sfValidatorString(array('max_length' => 250, 'required' => false)),
      'time_started'  => new sfValidatorTime(),
      'time_finished' => new sfValidatorTime(),
      'time'          => new sfValidatorTime(array('required' => false)),
      'created_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Creator'), 'required' => false)),
      'updated_by'    => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Updater'), 'required' => false)),
      'deleted_at'    => new sfValidatorDateTime(array('required' => false)),
      'created_at'    => new sfValidatorDateTime(),
      'updated_at'    => new sfValidatorDateTime(),
      'version'       => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('working_hour[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkingHour';
  }

}
