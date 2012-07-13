<?php

class FmcWhCheck {
  
  public function __construct () {
    
    $this->controller = sfContext::getInstance()->getController();
    $this->user = sfContext::getInstance()->getUser();
    
  }
  
  public function hasEnter ($date) {
    
    $records = Doctrine::getTable('WorkingHourDay')
      ->createQuery ('wh')
      ->addWhere ('wh.user_id = ?', $this->user->getGuardUser()->getId())
      ->addWhere ('wh.date = ?', $date)
      ->addWhere ('wh.type = ?', 'Enter')
      ->execute();
    
    $result = (count($records)) ? true : false;
    
    return $result;
  
  }
  
  
  
  
  
  
  
  
  // TODO: refactor below
  
  
  public function getLastEnter ($date)
  {
    $query = Doctrine::getTable('WorkingHour')
      ->createQuery ('wh')
      ->addWhere ('wh.user_id = ?', $this->user->getGuardUser()->getId())
      ->addWhere ('wh.date = ?', $date)
      ->addWhere ('wh.type = ?', 'Enter')
      ->addOrderBy ('wh.start DESC')
      ->limit(1);
    return $query->fetchOne();
  }
  
  public function getLastExit ($date)
  {
    $query = Doctrine::getTable('WorkingHour')
      ->createQuery ('wh')
      ->addWhere ('wh.user_id = ?', $this->user->getGuardUser()->getId())
      ->addWhere ('wh.date = ?', $date)
      ->addWhere ('wh.type = ?', 'Exit')
      ->addOrderBy ('wh.end DESC')
      ->limit(1);
    return $query->fetchOne();
  }
  
  public function CanEnter ($date)
  {
    $status = "";
    $sen = $this->getLastEnter($date);
    $sex = $this->getLastExit($date);
    
    // eger giris de cikis da yoksa izin ver
    if ($sen or $sex) //eger giris veya cikistan en az biri varsa
    {
      if ($sen and !$sex) //sadece giris varsa
        $status = "You have unexited jobs.";
      elseif ($sen and $sex)
        if ($sen > $sex)
          $status = "First you have to exit your last work";
    }
    
    return $status;
  }
  
  public function CanExit ($date)
  {
    $status = "";
    $sen = $this->getLastEnter($date);
    $sex = $this->getLastExit($date);
    
    if (!$sen and !$sex) //giris de cikis da yoksa
      $status = "First you have to enter.";
    elseif ($sex and !$sen) //giris yok cikisi varsa
      $status = "First you have to enter.";
    elseif ($sen and $sex)
      if ($sex > $sen) //cikis giristen sonraysa
        $status = "First you have to enter the office";
    
    return $status;
  }
  
  public function IsEnterRequired ($date)
  {
    $records = Doctrine::getTable('WorkingHour')
      ->createQuery ('wh')
      ->addWhere ('wh.user_id = ?', $this->user->getGuardUser()->getId())
      ->addWhere ('wh.date = ?', $date)
      ->addWhere ('wh.type = ?', 'Enter')
      ->execute();
    $result = (count($records)) ? false : true;
    return $result;
  }
  
  public function EnterTimeValid ($date, $time)
  {
    # yapilacak kontroller:
    # son girisi ve son cikisi al
    # eger son giris varsa ve cikis yoksa, cikissiz giris de
    # eger son giris ve cikis varsa, cikis<giris ise cikissiz giris de
    return true;
  }
  
  public function ExitTimeValid ($date, $time)
  {
    return true;
  }
  
}
