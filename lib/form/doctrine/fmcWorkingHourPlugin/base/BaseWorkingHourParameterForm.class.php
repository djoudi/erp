<?php

/**
 * WorkingHourParameter form base class.
 *
 * @method WorkingHourParameter getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseWorkingHourParameterForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'param'       => new sfWidgetFormInputText(),
      'value'       => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormInputText(),
      'creater_id'  => new sfWidgetFormInputText(),
      'updater_id'  => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'deleted_at'  => new sfWidgetFormDateTime(),
      'version'     => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'param'       => new sfValidatorString(array('max_length' => 50)),
      'value'       => new sfValidatorString(array('max_length' => 50)),
      'description' => new sfValidatorString(array('max_length' => 50)),
      'creater_id'  => new sfValidatorPass(),
      'updater_id'  => new sfValidatorPass(),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'deleted_at'  => new sfValidatorDateTime(array('required' => false)),
      'version'     => new sfValidatorInteger(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('working_hour_parameter[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'WorkingHourParameter';
  }

}
