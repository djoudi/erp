<?php

class sfGuardDepartmentForm extends PluginsfGuardGroupForm
{
  public function setupInheritance()
  {
    parent::setupInheritance();

    unset(
      $this['users_list'],
      $this['permissions_list'],
      $this['description']
    );
  }
}
