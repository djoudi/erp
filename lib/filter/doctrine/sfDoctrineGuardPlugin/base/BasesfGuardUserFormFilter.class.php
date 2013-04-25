<?php

/**
 * sfGuardUser filter form base class.
 *
 * @package    fmc
 * @subpackage filter
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BasesfGuardUserFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'first_name'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'last_name'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'title'                 => new sfWidgetFormFilterInput(),
      'email_address'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'username'              => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'algorithm'             => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'salt'                  => new sfWidgetFormFilterInput(),
      'password'              => new sfWidgetFormFilterInput(),
      'is_active'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'is_super_admin'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'last_login'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'group_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Department'), 'add_empty' => true)),
      'employment_start'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'employment_end'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'office_Entrance'       => new sfWidgetFormFilterInput(),
      'office_Exit'           => new sfWidgetFormFilterInput(),
      'default_Work_Type_id'  => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('DefaultWorkType'), 'add_empty' => true)),
      'monthly_Working_Hours' => new sfWidgetFormFilterInput(),
      'send_Email'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'creater_id'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updater_id'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'version'               => new sfWidgetFormFilterInput(),
      'permissions_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission')),
      'work_types_list'       => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'WorkingHourWorkType')),
    ));

    $this->setValidators(array(
      'first_name'            => new sfValidatorPass(array('required' => false)),
      'last_name'             => new sfValidatorPass(array('required' => false)),
      'title'                 => new sfValidatorPass(array('required' => false)),
      'email_address'         => new sfValidatorPass(array('required' => false)),
      'username'              => new sfValidatorPass(array('required' => false)),
      'algorithm'             => new sfValidatorPass(array('required' => false)),
      'salt'                  => new sfValidatorPass(array('required' => false)),
      'password'              => new sfValidatorPass(array('required' => false)),
      'is_active'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'is_super_admin'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'last_login'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'group_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Department'), 'column' => 'id')),
      'employment_start'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'employment_end'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDateTime(array('required' => false)))),
      'office_Entrance'       => new sfValidatorPass(array('required' => false)),
      'office_Exit'           => new sfValidatorPass(array('required' => false)),
      'default_Work_Type_id'  => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('DefaultWorkType'), 'column' => 'id')),
      'monthly_Working_Hours' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'send_Email'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'creater_id'            => new sfValidatorPass(array('required' => false)),
      'updater_id'            => new sfValidatorPass(array('required' => false)),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'version'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'permissions_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission', 'required' => false)),
      'work_types_list'       => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'WorkingHourWorkType', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addPermissionsListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.sfGuardUserPermission sfGuardUserPermission')
      ->andWhereIn('sfGuardUserPermission.permission_id', $values)
    ;
  }

  public function addWorkTypesListColumnQuery(Doctrine_Query $query, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $query
      ->leftJoin($query->getRootAlias().'.WorkingHourWorkTypeUser WorkingHourWorkTypeUser')
      ->andWhereIn('WorkingHourWorkTypeUser.worktype_id', $values)
    ;
  }

  public function getModelName()
  {
    return 'sfGuardUser';
  }

  public function getFields()
  {
    return array(
      'id'                    => 'Number',
      'first_name'            => 'Text',
      'last_name'             => 'Text',
      'title'                 => 'Text',
      'email_address'         => 'Text',
      'username'              => 'Text',
      'algorithm'             => 'Text',
      'salt'                  => 'Text',
      'password'              => 'Text',
      'is_active'             => 'Boolean',
      'is_super_admin'        => 'Boolean',
      'last_login'            => 'Date',
      'group_id'              => 'ForeignKey',
      'employment_start'      => 'Date',
      'employment_end'        => 'Date',
      'office_Entrance'       => 'Text',
      'office_Exit'           => 'Text',
      'default_Work_Type_id'  => 'ForeignKey',
      'monthly_Working_Hours' => 'Number',
      'send_Email'            => 'Boolean',
      'creater_id'            => 'Text',
      'updater_id'            => 'Text',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
      'deleted_at'            => 'Date',
      'version'               => 'Number',
      'permissions_list'      => 'ManyKey',
      'work_types_list'       => 'ManyKey',
    );
  }
}
