<?php

/**
 * sfGuardUserVersion form base class.
 *
 * @method sfGuardUserVersion getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserVersionForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                           => new sfWidgetFormInputHidden(),
      'first_name'                   => new sfWidgetFormInputText(),
      'last_name'                    => new sfWidgetFormInputText(),
      'title'                        => new sfWidgetFormInputText(),
      'email_address'                => new sfWidgetFormInputText(),
      'username'                     => new sfWidgetFormInputText(),
      'algorithm'                    => new sfWidgetFormInputText(),
      'salt'                         => new sfWidgetFormInputText(),
      'password'                     => new sfWidgetFormInputText(),
      'is_active'                    => new sfWidgetFormInputCheckbox(),
      'is_super_admin'               => new sfWidgetFormInputCheckbox(),
      'last_login'                   => new sfWidgetFormDateTime(),
      'group_id'                     => new sfWidgetFormInputText(),
      'required_daily_work_minutes'  => new sfWidgetFormInputText(),
      'required_daily_break_minutes' => new sfWidgetFormInputText(),
      'employment_start'             => new sfWidgetFormDate(),
      'employment_end'               => new sfWidgetFormDate(),
      'wh_balance_before_2013'       => new sfWidgetFormInputText(),
      'office_Entrance'              => new sfWidgetFormTime(),
      'office_Exit'                  => new sfWidgetFormTime(),
      'default_Work_Type_id'         => new sfWidgetFormInputText(),
      'monthly_Working_Hours'        => new sfWidgetFormInputText(),
      'send_Email'                   => new sfWidgetFormInputCheckbox(),
      'creater_id'                   => new sfWidgetFormInputText(),
      'updater_id'                   => new sfWidgetFormInputText(),
      'created_at'                   => new sfWidgetFormDateTime(),
      'updated_at'                   => new sfWidgetFormDateTime(),
      'deleted_at'                   => new sfWidgetFormDateTime(),
      'version'                      => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'id'                           => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'first_name'                   => new sfValidatorString(array('max_length' => 255)),
      'last_name'                    => new sfValidatorString(array('max_length' => 255)),
      'title'                        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email_address'                => new sfValidatorString(array('max_length' => 255)),
      'username'                     => new sfValidatorString(array('max_length' => 128)),
      'algorithm'                    => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'salt'                         => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'password'                     => new sfValidatorString(array('max_length' => 128, 'required' => false)),
      'is_active'                    => new sfValidatorBoolean(array('required' => false)),
      'is_super_admin'               => new sfValidatorBoolean(array('required' => false)),
      'last_login'                   => new sfValidatorDateTime(array('required' => false)),
      'group_id'                     => new sfValidatorInteger(array('required' => false)),
      'required_daily_work_minutes'  => new sfValidatorInteger(array('required' => false)),
      'required_daily_break_minutes' => new sfValidatorInteger(array('required' => false)),
      'employment_start'             => new sfValidatorDate(array('required' => false)),
      'employment_end'               => new sfValidatorDate(array('required' => false)),
      'wh_balance_before_2013'       => new sfValidatorInteger(array('required' => false)),
      'office_Entrance'              => new sfValidatorTime(array('required' => false)),
      'office_Exit'                  => new sfValidatorTime(array('required' => false)),
      'default_Work_Type_id'         => new sfValidatorInteger(array('required' => false)),
      'monthly_Working_Hours'        => new sfValidatorInteger(array('required' => false)),
      'send_Email'                   => new sfValidatorBoolean(array('required' => false)),
      'creater_id'                   => new sfValidatorPass(),
      'updater_id'                   => new sfValidatorPass(),
      'created_at'                   => new sfValidatorDateTime(),
      'updated_at'                   => new sfValidatorDateTime(),
      'deleted_at'                   => new sfValidatorDateTime(array('required' => false)),
      'version'                      => new sfValidatorChoice(array('choices' => array($this->getObject()->get('version')), 'empty_value' => $this->getObject()->get('version'), 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_version[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserVersion';
  }

}
