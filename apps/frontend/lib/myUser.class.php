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
  
  public function wh_checknewday ($date)
  {
    $records = Doctrine::getTable('WorkingHour')
      ->createQuery ('wh')
      ->addWhere ('wh.user_id = ?', $this->getGuardUser()->getId())
      ->addWhere ('wh.date = ?', $date)
      ->addWhere ('wh.type = ?', 'Enter')
      ->execute();
    return (count($records)>0) ? false : true;
  }
}
