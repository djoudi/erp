<?php

class PluginWorkingHourLeaveTable extends Doctrine_Table {
    
    
    public static function getInstance() {
        
        return Doctrine_Core::getTable('PluginWorkingHourLeave');
        
    }
    
    
    public function getActiveByUserAndDate ($user_id, $date) {
        
        $result = $this->CreateQuery ('whl')
            ->addWhere ('whl.user_id = ?', $user_id)
            ->addWhere ('whl.date = ?', $date)
            ->addWhere ('whl.status <> ?', 'Denied')
            ->addWhere ('whl.status <> ?', 'Cancelled')
            ->fetchOne();
        return $result;
    }
    
    
    public function cancelRequest ($user_id, $date) {
        
        $object = $this->CreateQuery ('whl')
            ->addWhere ('whl.user_id = ?', $user_id)
            ->addWhere ('whl.date = ?', $date)
            ->addWhere ('whl.status = ?', "Pending")
            ->fetchOne();
        $statusUser = sfContext::getInstance()->getUser()->getGuardUser();
        if ($object) {
            $object->setStatus ("Cancelled");
            $object->setStatusUser ($statusUser);
            $object->save();
        }
        
    }
    
    
    public function getUsedLeaveCount ($user_id, $type) {
        
        $count = $this->CreateQuery ('whl')
            ->addWhere ('whl.user_id = ?', $user_id)
            ->addWhere ('whl.type = ?', $type)
            ->addWhere ('whl.status = ?', "Approved")
            ->count();
        return $count;
    
    }
    
    
    public function hasLimit ($user, $type) {
        
        $usage = $this->getUsedLeaveCount ($user->getId(), $type);
        
        $limitTemp = "get".$type."Limit";
        $userLimit = $user->$limitTemp();
        
        return $userLimit > $usage;
    
    }
    
    
    public function prepareFilterMyRequests ($user_id, $limit = 100) {
        
        $query = $this->CreateQuery ('whl')
            ->leftJoin ('whl.StatusUser u')
            ->addWhere ('whl.user_id = ?', $user_id)
            ->limit ($limit)
            ->orderBy ('whl.date DESC');
        return $query;
        
    }
        
}






