<?php

class myUser extends sfGuardSecurityUser
{
  public function getMyCost ($cost_id)
  {
    return Doctrine::getTable('CostFormItem')
      ->createQuery('cfi')
      ->leftJoin('cfi.CostForms cf')
      ->addWhere('cfi.id = ?', $cost_id)
      ->addWhere('cf.user_id = ?', $this->getGuardUser()->getId())
      ->fetchOne();
  }
}
