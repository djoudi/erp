<?php

/**
 * Project filter form base class.
 *
 * @package    cfdb
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterBaseTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
abstract class BaseFormFilterDoctrine extends sfFormFilterDoctrine
{
  public function setup()
  {
    unset($this['created_at']);
    unset($this['updated_at']);
    unset($this['deleted_at']);
    unset($this['version']);
    unset($this['created_by']);
    unset($this['updated_by']);
  }
}
