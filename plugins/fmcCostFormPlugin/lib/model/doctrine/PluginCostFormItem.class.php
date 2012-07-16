<?php

abstract class PluginCostFormItem extends BaseCostFormItem {
    
    public function getWithoutVat() {
    
        if ( !$this->amount or $this->amount==0 )
            return 0;
        elseif ( $this->Vats->rate == 0)
            return $this->amount;
        else
            return round( 100/(100+$this->Vats->rate)*$this->amount , 2);
            
    }
    
    public function changePaidStatus () {
    
        $user = sfContext::getInstance()->getUser();
        
        $this->setIsPaid ( ! $this->getIsPaid() );
        $this->setUpdatedBy ($user->getGuardUser()->getId());
        $this->save();
        
    }
    
}
