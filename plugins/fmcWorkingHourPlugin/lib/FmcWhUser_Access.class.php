<?php

class FmcWhUser_Access {
    
    public function __construct () {

        $this->controller = sfContext::getInstance()->getController();
        $this->user = sfContext::getInstance()->getUser()->getGuardUser();
        $this->user_id = $this->user->getId();
        
    }
    
    public function getLeaveUsage () {
        
        $leaveStatus = sfConfig::get('app_workingHour_leaveStatus', array());
        
        $LeaveUsageCount = array();
        
        foreach ($leaveStatus as $key=>$label) {
            
            $result = Doctrine::getTable ('WorkingHourLeave')
                ->createQuery ('whl')
                ->addWhere ('whl.user_id = ?', $this->user->getId())
                ->addWhere ('type = ?', $key)
                ->addWhere ('status = ?', "Approved")
                ->count();
            
            $LeaveUsageCount[$key] = $result;
        }
        
        return $LeaveUsageCount;
        
    }
    
    
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
    
    public function deleteDay ($date) {
        
        $this->cancelDayLeave ($date);
        
        $items = Doctrine::getTable ('WorkingHour')
            ->createQuery ('wh')
            ->addWhere ('wh.user_id = ?', $this->user_id)
            ->addWhere ('wh.date = ?', $date)
            ->execute();
        $items->delete();
        
        $entranceExit = Doctrine::getTable ('WorkingHourDay')
            ->createQuery ('whd')
            ->addWhere ('whd.user_id = ?', $this->user_id)
            ->addWhere ('whd.date = ?', $date)
            ->execute();
        $entranceExit->delete();
        
    }
    
    public function cancelDayLeave ($date) {
        
        $object = Doctrine::getTable ('WorkingHourLeave')
            ->createQuery ('whl')
            ->addWhere ('whl.user_id = ?', $this->user_id)
            ->addWhere ('whl.date = ?', $date)
            ->addWhere ('whl.status = ?', 'Pending')
            ->fetchOne();
        
        if ($object) {
            $object->setStatus ('Cancelled');
            $object->setStatusUser ($this->user);
            $object->save();
        }
        
    }
    
    public function getDayLeave ($date) {
        
        $query = Doctrine::getTable('WorkingHourLeave')
            ->createQuery ('whl')
            ->addWhere ('whl.user_id = ?', $this->user_id)
            ->addWhere ('whl.date = ?', $date)
            ->addWhere ('whl.status <> ?', 'Denied')
            ->addWhere ('whl.status <> ?', 'Cancelled')
            ->limit (1);
        return $query->fetchOne();
    }
    
}
