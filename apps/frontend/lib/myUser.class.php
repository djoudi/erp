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
  
  public function checkNewDay ($date)
  {
    $records = Doctrine::getTable('WorkingHour')
      ->createQuery ('wh')
      ->addWhere ('wh.user_id = ?', $this->getGuardUser()->getId())
      ->addWhere ('wh.date = ?', $date)
      ->addWhere ('wh.type = ?', 'IO')
      ->execute();
    return count($records) ? false : true;
  }
}
