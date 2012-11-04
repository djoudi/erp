<?php

abstract class PluginCustomer extends BaseCustomer
{
    
    /* Lucene Search */
    
    public function delete(Doctrine_Connection $conn = null)
    {
        $index = CustomerTable::getLuceneIndex();
        foreach ($index->find('pk:'.$this->getId()) as $hit)
        {
            $index->delete($hit->id);
        }
        return parent::delete($conn);
    }
    
    public function save(Doctrine_Connection $conn = null)
    {
        $conn = $conn ? $conn : $this->getTable()->getConnection();
        $conn->beginTransaction();
        try
        {
            $ret = parent::save($conn);
            $this->updateLuceneIndex();
            $conn->commit();
            return $ret;
        }
        catch (Exception $e)
        {
            $conn->rollBack();
            throw $e;
        }
    }
    
    public function updateLuceneIndex()
    {
        $index = CustomerTable::getLuceneIndex();
        foreach ($index->find('pk:'.$this->getId()) as $hit)
        {
            $index->delete($hit->id);
        }
        $doc = new Zend_Search_Lucene_Document();
        $doc->addField(Zend_Search_Lucene_Field::Keyword('pk', $this->getId()));
        $doc->addField(Zend_Search_Lucene_Field::UnStored('name', $this->getName(), 'utf-8'));
        $index->addDocument($doc);
        $index->commit();
    }
    
    
}
