<?php

/**
 * WorkingHourEntranceExitVersion form base class.
 *
 * @method WorkingHourEntranceExitVersion getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWorkingHourEntranceExitVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'day_id'     => new sfWidgetFormInputText(),
      'type'       => new sfWidgetFormChoice(array('choices' => array('Entrance' => 'Entrance', 'Exit' => 'Exit'))),
      'time'       => new sfWidgetFormTime(),
      'creater_id' => new sfWidgetFormInputText(),
      'updater_id' => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'deleted_at' => new sfWidgetFormDateTime(),
      'version'    => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'day_id'     => new sfValidatorInteger(),
      'type'       => new sfValidatorChoice(array('choices' => array(0 => 'Entrance', 1 => 'Exit'), 'required' => false)),
      'time'       => new sfValidatorTime(),
      'creater_id' => new sfValidatorPass(),
      'updater_id' => new sfValidatorPass(),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
      'deleted_at' => new sfValidatorDateTime(array('required' => false)),
      'version'    => new sfValidatorChoice(array('choices' => array($this->getObject()->get('version')), 'empty_value' => $this->getObject()->get('version'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('working_hour_entrance_exit_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkingHourEntranceExitVersion';
  }

}
