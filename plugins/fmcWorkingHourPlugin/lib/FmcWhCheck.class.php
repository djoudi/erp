<?php

class FmcWhCheck
{
  public function __construct ()
  {
    $this->controller = sfContext::getInstance()->getController();
    $this->user = sfContext::getInstance()->getUser();
  }
  
  public function CanEnter ($date)
  {
    $status = "";
    return $status;
  }
  
  public function CanExit ($date)
  {
    $status = "";
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
