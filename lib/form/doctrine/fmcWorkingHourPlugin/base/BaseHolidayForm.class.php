<?php

/**
 * Holiday form base class.
 *
 * @method Holiday getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseHolidayForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'date'       => new sfWidgetFormInputHidden(),
      'name'       => new sfWidgetFormInputHidden(),
      'creater_id' => new sfWidgetFormInputText(),
      'updater_id' => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'deleted_at' => new sfWidgetFormDateTime(),
      'version'    => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'date'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('date')), 'empty_value' => $this->getObject()->get('date'), 'required' => false)),
      'name'       => new sfValidatorChoice(array('choices' => array($this->getObject()->get('name')), 'empty_value' => $this->getObject()->get('name'), 'required' => false)),
      'creater_id' => new sfValidatorPass(),
      'updater_id' => new sfValidatorPass(),
      'created_at' => new sfValidatorDateTime(),
      'updated_at' => new sfValidatorDateTime(),
      'deleted_at' => new sfValidatorDateTime(array('required' => false)),
      'version'    => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'Holiday', 'column' => array('date'))),
        new sfValidatorDoctrineUnique(array('model' => 'Holiday', 'column' => array('name'))),
      ))
    );

    $this->widgetSchema->setNameFormat('holiday[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Holiday';
  }

}
