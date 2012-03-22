<?php

/**
 * sfGuardUserTable
 * 
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class sfGuardUserTable extends PluginsfGuardUserTable
{
    /**
     * Returns an instance of this class.
     *
     * @return object sfGuardUserTable
     */
    public static function getInstance()
    {
        return Doctrine_Core::getTable('sfGuardUser');
    }
    
  public function __construct($name, Doctrine_Connection $conn, $initDefinition = false)
  {
    parent::__construct($name, $conn, $initDefinition);
    $this->_options['orderBy'] = 'first_name, last_name ASC';
  }
}
