<?php

class form_plugin_sfguarduser_new extends sfGuardUserForm
{
  public function configure()
  {
    
    unset(
      $this['algorithm'],
      $this['salt'],
      $this['is_super_admin'],   
      $this['last_login'],
      $this['groups_list']
    );
    
    $this->widgetSchema['password'] = new sfWidgetFormInputPassword();
    $this->validatorSchema['password']->setOption('required', true);
    $this->widgetSchema['password_again'] = new sfWidgetFormInputPassword();
    $this->validatorSchema['password_again'] = clone $this->validatorSchema['password'];

    $this->widgetSchema->moveField('password_again', 'after', 'password');
    $this->mergePostValidator(new sfValidatorSchemaCompare(
      'password', 
      sfValidatorSchemaCompare::EQUAL, 
      'password_again', 
      array(), 
      array('invalid' => 'The two passwords must be the same.'))
    );
    
    
    
    /* Refs #51 */
    $this->setWidget('group_id', new sfWidgetFormDoctrineChoice(array(
        'model' => 'sfGuardGroup',
        'add_empty' => false
    )));
    $this->validatorSchema['group_id']->setOption('required', true);
    /* End of Refs #51 */
    
    
    $this->widgetSchema['permissions_list'] = new sfWidgetFormSelectDoubleList(array(
      'choices' => $this->widgetSchema['permissions_list']->getChoices(), 
      'label_associated' => 'Granted',
      'label_unassociated' => 'Available'
    ));
    
    $this->widgetSchema['IllnessWReportLimit']->setLabel('Illness (with Report) Limit');
    $this->widgetSchema['IllnessWoReportLimit']->setLabel('Illness (without Report) Limit');
    $this->widgetSchema['PaidVacationLimit']->setLabel('Paid Vacation Limit');
    $this->widgetSchema['UnpaidVacationLimit']->setLabel('Unpaid Vacation Limit');
    
    $this->widgetSchema['group_id']->setLabel('Department');
    $this->widgetSchema['permissions_list']->setLabel('Permissions');
    $this->widgetSchema['password']->setLabel('Password');
    $this->widgetSchema['password_again']->setLabel('Password (again)');
    
  }
}
