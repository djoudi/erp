<?php

class Form_WHUser_newdaywork extends WorkingHourWorkForm
{
    public function configure()
    {
        parent::configure();
        
        unset($this['day_id']);
        
        $this->setWidget('start', new sfWidgetFormInputText());
        $this->setWidget('end', new sfWidgetFormInputText());
        
        /* $this->setDefault('time', "09:00"); */
        /* @TODO Default start, bir onceki saate gore otomatik hesaplanacak */
        /* @TODO Default end, default starttan bir saat sonra olacak */
        
        /* @TODO worktype lar kullaniciya gore gelecek */
        
        
        $this->setWidget('type_id', new sfWidgetFormDoctrineChoice(array(
            'model' => $this->getRelatedModelName('WorkType'),
            'table_method' => 'getCurrentUserList',
            'add_empty' => false)
        ));
    }  	
}
