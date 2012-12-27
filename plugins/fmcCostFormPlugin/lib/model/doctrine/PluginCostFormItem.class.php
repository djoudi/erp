<?php

abstract class PluginCostFormItem extends BaseCostFormItem
{
    
    public function getWithoutVat()
    {
        if ( !$this->amount or $this->amount==0 )
        {
            $result = 0;
        }
        elseif ( $this->Vats->rate == 0)
        {
            $result = $this->amount;
        }
        else
        {
            $result = round ( 100 / ( 100 + $this->Vats->rate ) * $this->amount , 2);
        }
        return $result;
    }
    
    public function changePaidStatus ()
    {
        $this->setIsPaid ( ! $this->getIsPaid() );
        $this->save();
    }
    
}
