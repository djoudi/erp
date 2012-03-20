<?php

class filterform_department extends sfGuardGroupFormFilter
{
  public function configure()
  {
    unset(
      $this['description'],
      $this['salt'],
      $this['permissions_list'],
      $this['users_list']
    );
  }
}
