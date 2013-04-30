<?php

/**
 * sfGuardUserVersion filter form base class.
 *
 * @package    fmc
 * @subpackage filter
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserVersionFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'first_name'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'last_name'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'                        => new sfWidgetFormFilterInput(),
      'email_address'                => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'username'                     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'algorithm'                    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'salt'                         => new sfWidgetFormFilterInput(),
      'password'                     => new sfWidgetFormFilterInput(),
      'is_active'                    => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_super_admin'               => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'last_login'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'group_id'                     => new sfWidgetFormFilterInput(),
      'required_daily_work_minutes'  => new sfWidgetFormFilterInput(),
      'required_daily_break_minutes' => new sfWidgetFormFilterInput(),
      'employment_start'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'employment_end'               => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'office_Entrance'              => new sfWidgetFormFilterInput(),
      'office_Exit'                  => new sfWidgetFormFilterInput(),
      'default_Work_Type_id'         => new sfWidgetFormFilterInput(),
      'monthly_Working_Hours'        => new sfWidgetFormFilterInput(),
      'send_Email'                   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'creater_id'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updater_id'                   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'                   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'first_name'                   => new sfValidatorPass(array('required' => false)),
      'last_name'                    => new sfValidatorPass(array('required' => false)),
      'title'                        => new sfValidatorPass(array('required' => false)),
      'email_address'                => new sfValidatorPass(array('required' => false)),
      'username'                     => new sfValidatorPass(array('required' => false)),
      'algorithm'                    => new sfValidatorPass(array('required' => false)),
      'salt'                         => new sfValidatorPass(array('required' => false)),
      'password'                     => new sfValidatorPass(array('required' => false)),
      'is_active'                    => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_super_admin'               => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'last_login'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'group_id'                     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'required_daily_work_minutes'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'required_daily_break_minutes' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'employment_start'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'employment_end'               => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'office_Entrance'              => new sfValidatorPass(array('required' => false)),
      'office_Exit'                  => new sfValidatorPass(array('required' => false)),
      'default_Work_Type_id'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'monthly_Working_Hours'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'send_Email'                   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'creater_id'                   => new sfValidatorPass(array('required' => false)),
      'updater_id'                   => new sfValidatorPass(array('required' => false)),
      'created_at'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'                   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_version_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardUserVersion';
  }

  public function getFields()
  {
    return array(
      'id'                           => 'Number',
      'first_name'                   => 'Text',
      'last_name'                    => 'Text',
      'title'                        => 'Text',
      'email_address'                => 'Text',
      'username'                     => 'Text',
      'algorithm'                    => 'Text',
      'salt'                         => 'Text',
      'password'                     => 'Text',
      'is_active'                    => 'Boolean',
      'is_super_admin'               => 'Boolean',
      'last_login'                   => 'Date',
      'group_id'                     => 'Number',
      'required_daily_work_minutes'  => 'Number',
      'required_daily_break_minutes' => 'Number',
      'employment_start'             => 'Date',
      'employment_end'               => 'Date',
      'office_Entrance'              => 'Text',
      'office_Exit'                  => 'Text',
      'default_Work_Type_id'         => 'Number',
      'monthly_Working_Hours'        => 'Number',
      'send_Email'                   => 'Boolean',
      'creater_id'                   => 'Text',
      'updater_id'                   => 'Text',
      'created_at'                   => 'Date',
      'updated_at'                   => 'Date',
      'deleted_at'                   => 'Date',
      'version'                      => 'Number',
    );
  }
}
