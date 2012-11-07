<?php

/**
 * sfGuardGroupVersion form base class.
 *
 * @method sfGuardGroupVersion getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfGuardGroupVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'name'                => new sfWidgetFormInputText(),
      'description'         => new sfWidgetFormTextarea(),
      'manager_id'          => new sfWidgetFormInputText(),
      'default_Worktype_id' => new sfWidgetFormInputText(),
      'creater_id'          => new sfWidgetFormInputText(),
      'updater_id'          => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'deleted_at'          => new sfWidgetFormDateTime(),
      'version'             => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'         => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'manager_id'          => new sfValidatorInteger(),
      'default_Worktype_id' => new sfValidatorInteger(array('required' => false)),
      'creater_id'          => new sfValidatorPass(),
      'updater_id'          => new sfValidatorPass(),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'deleted_at'          => new sfValidatorDateTime(array('required' => false)),
      'version'             => new sfValidatorChoice(array('choices' => array($this->getObject()->get('version')), 'empty_value' => $this->getObject()->get('version'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_group_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardGroupVersion';
  }

}
