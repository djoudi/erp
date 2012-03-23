<?php

abstract class BaseworkingHourUserActions extends sfActions
{
  
  
  
  
  public function executeHome (sfWebRequest $request)
  {
    $user = $this->getUser()->getGuardUser();
    $this->todayItems = Doctrine::getTable('WorkingHour')->getByuseranddate($user->getId(), date('Y-m-d'));
    $this->lastItems = Doctrine::getTable('WorkingHour')->getLastItems($user->getId(), 5);
  }
  
  
  
  
  
  public function executeEnterday (sfWebRequest $request)
  {
    // fetching date and user
      $this->date = $request->getParameter('date');
      $user = $this->getUser()->getGuardUser();
      $editurl = $this->getController()->genUrl('@workingHourUser_editday?date='.$this->date);
    
    // checking if day has enterance already
      if (!$this->getUser()->wh_checknewday($this->date))
      {
        $this->getUser()->setFlash('notice', 'To enter, you have to exit.');
        $this->redirect($editurl);
      }
    
    // preparing form
      $item = new WorkingHour();
      $item->setType('Enter');
      $item->setDate($this->date);
      $item->setUser($user);
      $item->setStart('09:00');
      $this->form = new WorkingHourForm_user_io ($item);
    
    // processing form    
      $proc = new FmcProcessWh();
      $proc->ProcessEnterance ($this->form, $request, $editurl);
  }
  
  
  
  
  public function executeEditday (sfWebRequest $request)
  {
    // fetching date and user
      $this->date = $request->getParameter('date');
      $user = $this->getUser()->getGuardUser();
      $editurl = $this->getController()->genUrl('@workingHourUser_editday_enterance?date='.$this->date);
    
    // checking if day has enterance
      if ($this->getUser()->wh_checknewday($this->date))
      {
        $this->getUser()->setFlash('notice', 'You should enter your enterance hour first.');
        $this->redirect($editurl);
      }
    
    // fetching todays items
      $this->items = Doctrine::getTable('WorkingHour')->getByuseranddate($user->getId(), $this->date);
    
    // preparing form
      $this->item = new WorkingHour();
      $this->item->setDate($this->date);
      $this->item->setUser($user);
      $time = strtotime($this->item->getNexthour($this->date));
      $this->item->setStart(date('H:i',$time));
      $this->item->setEnd(date('H:i',$time + 1800));
      $this->form = new WorkingHourForm_User ($this->item);
    
    // processing form
      $processClass = new FmcProcessForm();
      $processClass->ProcessWorkingHourForm($this->form, $request, $editurl, $this->items);
    
    # process kismi duzeltilecek - aktarilacak
    # edit item konacak    
  }
  
  
  
  
  
  public function executeEdit (sfWebRequest $request)
  {
    $user = $this->getUser()->getGuardUser();
    $this->date = $request->getParameter('date');
    
    $this->isnewday = $this->getUser()->checkNewDay ($this->date);
    
    
    
    
    
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
      $this->item = new WorkingHour();
      $this->item->setDate($this->date);
      $this->item->setUser($user);
      
      $this->ioform = new WorkingHourForm_user_io ($this->item);
      
      $time = strtotime($this->item->getNexthour($this->date));
      $this->item->setStart(date('H:i',$time));
      $this->item->setEnd(date('H:i',$time + 1800));
      $this->form = new WorkingHourForm_User ($this->item);
      
    }
    
    $processClass = new FmcProcessForm();
    $processClass->ProcessWorkingHourForm($this->form, $request, "@workingHourUser_edit?date=".$this->date, $this->items);
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
