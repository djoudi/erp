<?php

class filterform_plugin_sfguarduser extends sfGuardUserFormFilter
{
  public function configure()
  {
    unset(
      $this['algorithm'],
      $this['salt'],
      $this['is_super_admin'],   
      $this['last_login'],
      $this['groups_list'],
      $this['password'],
      $this['salt'],
      $this['permissions_list']
    );
    
    $this->widgetSchema['group_id']->setLabel('Department');
  }
}
