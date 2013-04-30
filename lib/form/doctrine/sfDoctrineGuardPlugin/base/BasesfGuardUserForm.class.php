<?php

/**
 * sfGuardUser form base class.
 *
 * @method sfGuardUser getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserForm extends BaseFormDoctrine
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
      'group_id'                     => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Department'), 'add_empty' => true)),
      'required_daily_work_minutes'  => new sfWidgetFormInputText(),
      'required_daily_break_minutes' => new sfWidgetFormInputText(),
      'employment_start'             => new sfWidgetFormDate(),
      'employment_end'               => new sfWidgetFormDate(),
      'wh_balance_before_2013'       => new sfWidgetFormInputText(),
      'office_Entrance'              => new sfWidgetFormTime(),
      'office_Exit'                  => new sfWidgetFormTime(),
      'default_Work_Type_id'         => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DefaultWorkType'), 'add_empty' => true)),
      'monthly_Working_Hours'        => new sfWidgetFormInputText(),
      'send_Email'                   => new sfWidgetFormInputCheckbox(),
      'creater_id'                   => new sfWidgetFormInputText(),
      'updater_id'                   => new sfWidgetFormInputText(),
      'created_at'                   => new sfWidgetFormDateTime(),
      'updated_at'                   => new sfWidgetFormDateTime(),
      'deleted_at'                   => new sfWidgetFormDateTime(),
      'version'                      => new sfWidgetFormInputText(),
      'permissions_list'             => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission')),
      'work_types_list'              => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'WorkingHourWorkType')),
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
      'group_id'                     => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Department'), 'required' => false)),
      'required_daily_work_minutes'  => new sfValidatorInteger(array('required' => false)),
      'required_daily_break_minutes' => new sfValidatorInteger(array('required' => false)),
      'employment_start'             => new sfValidatorDate(array('required' => false)),
      'employment_end'               => new sfValidatorDate(array('required' => false)),
      'wh_balance_before_2013'       => new sfValidatorInteger(array('required' => false)),
      'office_Entrance'              => new sfValidatorTime(array('required' => false)),
      'office_Exit'                  => new sfValidatorTime(array('required' => false)),
      'default_Work_Type_id'         => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('DefaultWorkType'), 'required' => false)),
      'monthly_Working_Hours'        => new sfValidatorInteger(array('required' => false)),
      'send_Email'                   => new sfValidatorBoolean(array('required' => false)),
      'creater_id'                   => new sfValidatorPass(),
      'updater_id'                   => new sfValidatorPass(),
      'created_at'                   => new sfValidatorDateTime(),
      'updated_at'                   => new sfValidatorDateTime(),
      'deleted_at'                   => new sfValidatorDateTime(array('required' => false)),
      'version'                      => new sfValidatorInteger(array('required' => false)),
      'permissions_list'             => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission', 'required' => false)),
      'work_types_list'              => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'WorkingHourWorkType', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorAnd(array(
        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('email_address'))),
        new sfValidatorDoctrineUnique(array('model' => 'sfGuardUser', 'column' => array('username'))),
      ))
    );

    $this->widgetSchema->setNameFormat('sf_guard_user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUser';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['permissions_list']))
    {
      $this->setDefault('permissions_list', $this->object->Permissions->getPrimaryKeys());
    }

    if (isset($this->widgetSchema['work_types_list']))
    {
      $this->setDefault('work_types_list', $this->object->WorkTypes->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->savePermissionsList($con);
    $this->saveWorkTypesList($con);

    parent::doSave($con);
  }

  public function savePermissionsList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['permissions_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->Permissions->getPrimaryKeys();
    $values = $this->getValue('permissions_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('Permissions', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('Permissions', array_values($link));
    }
  }

  public function saveWorkTypesList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['work_types_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (null === $con)
    {
      $con = $this->getConnection();
    }

    $existing = $this->object->WorkTypes->getPrimaryKeys();
    $values = $this->getValue('work_types_list');
    if (!is_array($values))
    {
      $values = array();
    }

    $unlink = array_diff($existing, $values);
    if (count($unlink))
    {
      $this->object->unlink('WorkTypes', array_values($unlink));
    }

    $link = array_diff($values, $existing);
    if (count($link))
    {
      $this->object->link('WorkTypes', array_values($link));
    }
  }

}
