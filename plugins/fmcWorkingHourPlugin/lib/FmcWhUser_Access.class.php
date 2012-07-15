<?php

class FmcWhUser_Access {
    
    public function __construct () {

        $this->controller = sfContext::getInstance()->getController();
        $this->user = sfContext::getInstance()->getUser();
        
    }
    
    public function getMyLeaveRequestsFilterQuery ($limit=100) {
        
        $query = Doctrine_Query::create()
            ->from ('WorkingHourLeave whl')
            ->leftJoin ('whl.StatusUser u')
            ->addWhere ('whl.user_id = ?', $this->user->getGuardUser()->getId())
            ->limit ($limit)
            ->orderBy ('whl.date DESC')
        ;
        return $query;
    }
    
    public function cancelDayLeave ($date) {
        
        $object = Doctrine::getTable ('WorkingHourLeave')
            ->createQuery ('whl')
            ->addWhere ('whl.user_id = ?', $this->user->getGuardUser()->getId())
            ->addWhere ('whl.date = ?', $date)
            ->addWhere ('whl.status = ?', 'Pending')
            ->fetchOne();
        
        if ($object) {
            $object->setStatus ('Cancelled');
            $object->setStatusUser ($this->user->getGuardUser());
            $object->save();
        }
        
    }
    
    public function getDayLeave ($date) {
        
        $query = Doctrine::getTable('WorkingHourLeave')
            ->createQuery ('whl')
            ->addWhere ('whl.user_id = ?', $this->user->getGuardUser()->getId())
            ->addWhere ('whl.date = ?', $date)
            ->addWhere ('whl.status <> ?', 'Denied')
            ->addWhere ('whl.status <> ?', 'Cancelled')
            ->limit (1);
        return $query->fetchOne();
    }
    
}
