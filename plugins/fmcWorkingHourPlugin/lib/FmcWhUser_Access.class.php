<?php

class FmcWhUser_Access {
    
    public function __construct () {

        $this->controller = sfContext::getInstance()->getController();
        $this->user = sfContext::getInstance()->getUser()->getGuardUser();
        $this->user_id = $this->user->getId();
        
    }
    
    
    /* ###################################################################### */
    
    
    public function getLeaveUsage () {
        
        $leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
        
        $LeaveUsageCount = array();
        
        foreach ($leaveStatus as $key=>$label) {
            
            $LeaveUsageCount[$key] = Doctrine::getTable ('WorkingHourLeave')
                ->getUsedLeaveCount ($this->user_id, $key);
        }
        
        return $LeaveUsageCount;
        
    }
    
    
    /* ###################################################################### */
    
    
    /* @TODO: to be deleted and replaced with table class method */
    public function getDayEntrance ($date) {
        
        $result = Doctrine::getTable ('WorkingHourDay')
            ->createQuery ('whd')
            ->addWhere ('whd.user_id = ?', $this->user_id)
            ->addWhere ('whd.date = ?', $date)
            ->addWhere ('whd.type = ?', 'Enter')
            ->fetchOne();
        return $result->toArray();
        
    }
    
    
    /* ###################################################################### */
    
    
    public function getMyLeaveRequestsFilterQuery ($limit=100) {
        
        $query = Doctrine_Query::create()
            ->from ('WorkingHourLeave whl')
            ->leftJoin ('whl.StatusUser u')
            ->addWhere ('whl.user_id = ?', $this->user_id)
            ->limit ($limit)
            ->orderBy ('whl.date DESC')
        ;
        return $query;
    }
    
    
    /* ###################################################################### */
    
    
    public function deleteDay ($date) {
        
        $leave = Doctrine::getTable ('WorkingHourLeave')
            ->cancelRequest ($this->user_id, $date);
        
        $items = Doctrine::getTable ('WorkingHour')
            ->cancelItems ($this->user_id, $date);
        
        $officeIo = Doctrine::getTable ('WorkingHourDay')
            ->deleteIo ($this->user_id, $date);
        
    }
        
    
    /* ###################################################################### */
    
}
