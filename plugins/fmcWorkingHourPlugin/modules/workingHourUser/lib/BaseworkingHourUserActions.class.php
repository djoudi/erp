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
    
    if ($item_id = $request->getParameter('item_id'))
    {      
      $this->getUser()->setAttribute('item_id', $item_id);
      $this->redirect($this->getController()->genUrl('@workingHourUser_edit?date='.$this->date));
    }
    elseif ($this->getUser()->getAttribute('item_id'))
    {
      $item_id = $this->getUser()->getAttribute('item_id');
      $this->getUser()->getAttributeHolder()->remove('item_id');
      
      $item_old = Doctrine::getTable('WorkingHour')
        ->createQuery ('wh')
        ->addWhere ('id = ?', $item_id)
        ->addWhere ('wh.user_id = ?', $user->getId())
        ->fetchOne();
      $item = $item_old->copy();
      $item_old->delete();
      
      $this->form = new WorkingHourForm_User ($item);
    }
    
    $this->item = Doctrine::getTable('WorkingHour')->findOneByDate($this->date);
    $this->items = Doctrine::getTable('WorkingHour')->getByuseranddate($user->getId(), $this->date);
    
    if (!$item_id)
    {
      $this->item = new WorkingHour ($this->costForm);

      $this->item->setDate($this->date);
      $this->item->setUser($user);
      
      $time = strtotime($this->item->getNexthour($this->date));
      $this->item->setStart(date('H:i',$time));
      $this->item->setEnd(date('H:i',$time + 1800));
      
      $this->form = new WorkingHourForm_User ($this->item);
    }
    
    $processClass = new FmcProcessForm();
    $processClass->ProcessWorkingHourForm($this->form, $request, "@workingHourUser_edit?date=".$this->date, $this->items);
    #$processClass->ProcessForm($this->form, $request, "@workingHourUser_edit?date=".$this->date, true);
  }
  
  
  public function executeItemDelete (sfWebRequest $request)
  {
    $item = Doctrine::getTable('WorkingHour')->find($request->getParameter('item_id'));
    $this->forward404Unless ($item);
    
    $item->setUpdatedBy($this->getUser()->getGuardUser()->getId());
    $item->save();
    $item->delete();
    
    $this->redirect($request->getReferer());
  }
  
  
}
