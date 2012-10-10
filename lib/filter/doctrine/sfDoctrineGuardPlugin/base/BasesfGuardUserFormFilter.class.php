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
      'group_id'              => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Groups'), 'add_empty' => true)),
      'IllnessWoReportLimit'  => new sfWidgetFormFilterInput(),
      'IllnessWReportLimit'   => new sfWidgetFormFilterInput(),
      'PaidVacationLimit'     => new sfWidgetFormFilterInput(),
      'UnpaidVacationLimit'   => new sfWidgetFormFilterInput(),
      'Monthly_Working_Hours' => new sfWidgetFormFilterInput(),
      'creater_id'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'updater_id'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'created_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'deleted_at'            => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'version'               => new sfWidgetFormFilterInput(),
      'groups_list'           => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup')),
      'permissions_list'      => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission')),
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
      'group_id'              => new sfValidatorDoctrineChoice(array('required' => false, 'model' => $this->getRelatedModelName('Groups'), 'column' => 'id')),
      'IllnessWoReportLimit'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'IllnessWReportLimit'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'PaidVacationLimit'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'UnpaidVacationLimit'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'Monthly_Working_Hours' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'creater_id'            => new sfValidatorPass(array('required' => false)),
      'updater_id'            => new sfValidatorPass(array('required' => false)),
      'created_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'updated_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'deleted_at'            => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 00:00:00')), 'to_date' => new sfValidatorDateTime(array('required' => false, 'datetime_output' => 'Y-m-d 23:59:59')))),
      'version'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'groups_list'           => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardGroup', 'required' => false)),
      'permissions_list'      => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'sfGuardPermission', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sf_guard_user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function addGroupsListColumnQuery(Doctrine_Query $query, $field, $values)
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
      ->leftJoin($query->getRootAlias().'.sfGuardUserGroup sfGuardUserGroup')
      ->andWhereIn('sfGuardUserGroup.sf_guard_group_id', $values)
    ;
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
      'IllnessWoReportLimit'  => 'Number',
      'IllnessWReportLimit'   => 'Number',
      'PaidVacationLimit'     => 'Number',
      'UnpaidVacationLimit'   => 'Number',
      'Monthly_Working_Hours' => 'Number',
      'creater_id'            => 'Text',
      'updater_id'            => 'Text',
      'created_at'            => 'Date',
      'updated_at'            => 'Date',
      'deleted_at'            => 'Date',
      'version'               => 'Number',
      'groups_list'           => 'ManyKey',
      'permissions_list'      => 'ManyKey',
    );
  }
}
