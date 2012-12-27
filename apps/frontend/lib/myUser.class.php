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
    
    public function getMyCostForm ($costform_id)
    {
        $q = Doctrine::getTable('CostForm')
            ->createQuery('cf')
            ->addWhere('cf.id = ?', $costform_id)
            ->addWhere('cf.user_id = ?', $this->getGuardUser()->getId())
        ;
        return $q->fetchOne();
    }
    
}
