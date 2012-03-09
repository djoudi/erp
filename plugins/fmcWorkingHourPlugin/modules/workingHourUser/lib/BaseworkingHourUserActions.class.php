<?php

abstract class BaseworkingHourUserActions extends sfActions
{
  public function executeHome (sfWebRequest $request)
  {
    $user = $this->getUser()->getGuardUser();
    $this->todayItems = Doctrine::getTable('WorkingHour')->getUserHoursToday($user->getId());
    
    
    $this->item = new WorkingHour();
    $this->item->setDate(date("Y-m-d"));
    $this->item->setUser($user);
    
    $this->form = new WorkingHourForm_User($this->item);
    
    $processClass = new FmcProcessForm();
    $processClass->ProcessForm($this->form, $request, "@workingHourUser_home", true);
    
  }
}
