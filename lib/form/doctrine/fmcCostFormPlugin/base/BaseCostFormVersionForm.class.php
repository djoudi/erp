<?php

/**
 * CostFormVersion form base class.
 *
 * @method CostFormVersion getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseCostFormVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'user_id'         => new sfWidgetFormInputText(),
      'project_id'      => new sfWidgetFormInputText(),
      'advanceRecieved' => new sfWidgetFormInputText(),
      'currency_id'     => new sfWidgetFormInputText(),
      'isSent'          => new sfWidgetFormInputCheckbox(),
      'creater_id'      => new sfWidgetFormInputText(),
      'updater_id'      => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
      'deleted_at'      => new sfWidgetFormDateTime(),
      'version'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'user_id'         => new sfValidatorInteger(array('required' => false)),
      'project_id'      => new sfValidatorInteger(),
      'advanceRecieved' => new sfValidatorNumber(array('required' => false)),
      'currency_id'     => new sfValidatorInteger(),
      'isSent'          => new sfValidatorBoolean(array('required' => false)),
      'creater_id'      => new sfValidatorPass(),
      'updater_id'      => new sfValidatorPass(),
      'created_at'      => new sfValidatorDateTime(),
      'updated_at'      => new sfValidatorDateTime(),
      'deleted_at'      => new sfValidatorDateTime(array('required' => false)),
      'version'         => new sfValidatorChoice(array('choices' => array($this->getObject()->get('version')), 'empty_value' => $this->getObject()->get('version'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('cost_form_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'CostFormVersion';
  }

}
