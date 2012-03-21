<?php

abstract class BaseworkingHourUserActions extends sfActions
{
  public function executeHome (sfWebRequest $request)
  {
    $user = $this->getUser()->getGuardUser();
    $this->todayItems = Doctrine::getTable('WorkingHour')->getByuseranddate($user->getId(), date('Y-m-d'));
  }
  
  public function executeEdit (sfWebRequest $request)
  {
    $user = $this->getUser()->getGuardUser();
    $this->date = $request->getParameter('date');
    $this->items = Doctrine::getTable('WorkingHour')->getByuseranddate($user->getId(), $this->date);
    
    $this->item = new WorkingHour();
    $this->item->setDate(date("Y-m-d"));
    $this->item->setUser($user);
    
    
    #$time = strtotime("09:00");
    $time = strtotime($this->item->getNexthour());
    
    #print_r( $time->toArray());
    #var_dump($time);
    $this->item->setStart(date('H:i',$time));
    $this->item->setEnd(date('H:i',$time + 1800));
    
    
    
    $this->form = new WorkingHourForm_User($this->item);
    $processClass = new FmcProcessForm();
    $processClass->ProcessForm($this->form, $request, "@workingHourUser_edit?date=".$this->date, true);
  }
}
