<?php

abstract class PluginsfGuardPermissionTable extends Doctrine_Table
{
  public function getOrdered()
  {
    return $this->CreateQuery ('perm')
      ->orderBy ('perm.name ASC')
      ->execute();
  }
}
