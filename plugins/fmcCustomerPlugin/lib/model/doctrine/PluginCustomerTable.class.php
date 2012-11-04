<?php

class PluginCustomerTable extends Doctrine_Table
{
    
    /* Symfony search */
    
    public function getForLuceneQuery($query)
    {
        $hits = self::getLuceneIndex()->find($query);
        $pks = array();
        foreach ($hits as $hit)
        {
            $pks[] = $hit->pk;
        }
        if (empty($pks))
        {
            return array();
        }
        $q = $this->createQuery('j')
            ->whereIn('j.id', $pks)
            ->limit(20);
        return $q->execute();
    }
    
    static public function getLuceneIndex()
    {
        ProjectConfiguration::registerZend();
        if (file_exists($index = self::getLuceneIndexFile()))
        {
            return Zend_Search_Lucene::open($index);
        }
        return Zend_Search_Lucene::create($index);
    }
    
    static public function getLuceneIndexFile()
    {
        #return sfConfig::get('sf_data_dir').'/customer.'.sfConfig::get('sf_environment').'.index';
        return sfConfig::get('sf_data_dir').'/customer.index';
    }
    
    
    
    
  
  public static function getInstance()
  {
    return Doctrine_Core::getTable('PluginCustomer');
  }
  
  public function __construct($name, Doctrine_Connection $conn, $initDefinition = false)
  {
    parent::__construct($name, $conn, $initDefinition);
    $this->_options['orderBy'] = 'name ASC';
  }
  
  public function getOrdered()
  {
    return $this->CreateQuery('cfi')
      ->orderBy('name ASC')
      ->execute();
  }
}
