<?php

class Fmc_Wh_Day
{
    public static function getMultiplier ($date)
    {
        $timestamp = strtotime($date);
        $dayoftheweek = date ("N", $timestamp);
        
        if ($dayoftheweek > 5) // if weekend
        {
            $holiday = 1;
        }
        elseif (Doctrine::getTable('Holiday')->findOneByDay($date))
        {
            $holiday = 1;
        }
        else $holiday = 0;
        
        if ($holiday)
        {
            $param = Doctrine::getTable('WorkingHourParameter')->findOneByParam('WeekendMultiplier');
            $multiplier = $param['value'];
        }
        else $multiplier = 1;
        
        return $multiplier;
    }
    
    
    public static function getStatus ($date)
    {
        
        #$stamp = strtotime($date);
        #echo date("N", $stamp);
        echo Fmc_Wh_Day::getMultiplier($date);
        
        
        
        
        $user = sfContext::getInstance()->getUser();
        $user_id = $user->getGuardUser()->getId();
        
        $whday = Doctrine::getTable('WorkingHourDay')->getActiveForUserDate($user_id, $date);
        
        if ($whday) 
        {
            if ($whday['leave_id']) $status = "leave";
            else $status = "workday";
        }
        else
        {
            $status = "empty";
        }
        
        return $status;
    }


}
?>
<?php
/*
    
class FmcFilter {
    
    private $formName;
    private $user;
    private $filter;
    private $filtered;
    private $controller;

    public function __construct($formname) {
  
        $this->formName = $formname;
        $this->user = sfContext::getInstance()->getUser();
        $this->controller = sfContext::getInstance()->getController();
        
    }
    
    public function getFilter() {
    
        return ($this->filter);
    }
    
    public function getFiltered() {
  
        return ($this->filtered);
        
    }
    
    public function resetForm() {
    
        $this->setFilters (array());
        $this->controller->redirect($request->getReferer());
        
    }
    
    public function initFilterForm (sfWebRequest $request, Doctrine_Query $q) {
    
        $this->filter = new $this->formName ($this->getFilters());
  
        if($request->isMethod('post')) {
    
            if($request->hasParameter('_reset')) {
                $this->setFilters (array());
                $this->controller->redirect($request->getReferer());  
            }
    
            $this->filter->bind ( $request->getParameter ($this->filter->getName()) );
    
            if($this->filter->isValid()) {
                $this->setFilters($this->filter->getValues());
                $this->controller->redirect($request->getReferer());
            }
        }
        
        $this->filtered = count($this->getFilters()) > 0;
        $this->filter->setQuery($q);
  
        return $this->filter->buildQuery($this->getFilters());
    }
    
    public function getFilters() {
        
        return $this->user->getAttribute('cf_filters', array());
    }
    
    public function setFilters($filters) {
  
        $this->user->setAttribute('cf_filters', $filters);
    }

}
*/
