<?php

/**
 * sfGuardGroup form base class.
 *
 * @method sfGuardGroup getObject() Returns the current form's model object
 *
 * @package    fmc
 * @subpackage form
 * @author     Yasin Aydin (yasin@yasinaydin.net)
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BasesfGuardGroupForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'name'                => new sfWidgetFormInputText(),
      'description'         => new sfWidgetFormTextarea(),
      'manager_id'          => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Manager'), 'add_empty' => false)),
      'default_Worktype_id' => new sfWidgetFormDoctrineChoice(array('model' => $this->getRelatedModelName('Default_Work_Type'), 'add_empty' => false)),
      'creater_id'          => new sfWidgetFormInputText(),
      'updater_id'          => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'deleted_at'          => new sfWidgetFormDateTime(),
      'version'             => new sfWidgetFormInputText(),
      'work_types_list'     => new sfWidgetFormDoctrineChoice(array('multiple' => true, 'model' => 'WorkingHourWorkType')),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'name'                => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description'         => new sfValidatorString(array('max_length' => 1000, 'required' => false)),
      'manager_id'          => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Manager'))),
      'default_Worktype_id' => new sfValidatorDoctrineChoice(array('model' => $this->getRelatedModelName('Default_Work_Type'), 'required' => false)),
      'creater_id'          => new sfValidatorPass(),
      'updater_id'          => new sfValidatorPass(),
      'created_at'          => new sfValidatorDateTime(),
      'updated_at'          => new sfValidatorDateTime(),
      'deleted_at'          => new sfValidatorDateTime(array('required' => false)),
      'version'             => new sfValidatorInteger(array('required' => false)),
      'work_types_list'     => new sfValidatorDoctrineChoice(array('multiple' => true, 'model' => 'WorkingHourWorkType', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorDoctrineUnique(array('model' => 'sfGuardGroup', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('sf_guard_group[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'sfGuardGroup';
  }

  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['work_types_list']))
    {
      $this->setDefault('work_types_list', $this->object->WorkTypes->getPrimaryKeys());
    }

  }

  protected function doSave($con = null)
  {
    $this->saveWorkTypesList($con);

    parent::doSave($con);
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
