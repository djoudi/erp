<?php

abstract class PluginsfGuardPermissionTable extends Doctrine_Table
{
  public function getOrdered()
  {
    return $this->CreateQuery ('perm')
      ->execute();
  }
}
