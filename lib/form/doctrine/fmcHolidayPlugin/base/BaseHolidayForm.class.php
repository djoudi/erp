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
      'id'           => new sfWidgetFormInputHidden(),
      'day'          => new sfWidgetFormDate(),
      'name'         => new sfWidgetFormInputText(),
      'holiday_type' => new sfWidgetFormChoice(array('choices' => array('Half-day' => 'Half-day', 'Full-day' => 'Full-day'))),
      'creater_id'   => new sfWidgetFormInputText(),
      'updater_id'   => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'deleted_at'   => new sfWidgetFormDateTime(),
      'version'      => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'day'          => new sfValidatorDate(),
      'name'         => new sfValidatorString(array('max_length' => 50)),
      'holiday_type' => new sfValidatorChoice(array('choices' => array(0 => 'Half-day', 1 => 'Full-day'), 'required' => false)),
      'creater_id'   => new sfValidatorPass(),
      'updater_id'   => new sfValidatorPass(),
      'created_at'   => new sfValidatorDateTime(),
      'updated_at'   => new sfValidatorDateTime(),
      'deleted_at'   => new sfValidatorDateTime(array('required' => false)),
      'version'      => new sfValidatorInteger(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'Holiday', 'column' => array('day')))
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
