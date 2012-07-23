<?php

class FmcWhUser_Check {
    
    public function __construct () {

        $this->controller = sfContext::getInstance()->getController();
        $this->user = sfContext::getInstance()->getUser();
        
    }
    
    public function hasLeaveLimit ($type) {
        
        $accessClass = new FmcWhUser_Access();
        
        $usage = $accessClass->getLeaveUsageForType($type);
        
        $limitTemp = "get".$type."Limit";
        $userLimit = $this->user->getGuardUser()->$limitTemp();
        
        return $userLimit > $usage;
        
    }
    
    public function isDayEmpty ($date) {
        
        $entranceRecords = Doctrine::getTable('WorkingHourDay')
            ->createQuery ('whd')
            ->addWhere ('whd.user_id = ?', $this->user->getGuardUser()->getId())
            ->addWhere ('whd.date = ?', $date)
            ->addWhere ('whd.type = ?', 'Enter')
            ->execute();
        
        $leaveRecords = Doctrine::getTable('WorkingHourLeave')
            ->createQuery ('whl')
            ->addWhere ('whl.user_id = ?', $this->user->getGuardUser()->getId())
            ->addWhere ('whl.date = ?', $date)
            ->addWhere ('whl.status <> ?', 'Denied')
            ->addWhere ('whl.status <> ?', 'Cancelled')
            ->execute();
        
        $totalRecords = count($entranceRecords) + count($leaveRecords); //gune ait nesne sayisi
        
        return $totalRecords ? false : true;
        
    }
    
}
