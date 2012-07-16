<?php

abstract class PluginCostForm extends BaseCostForm {
    
    public function getTotalStatus() {
    
        if ( ! $this->isSent ) {
            
            return "NotSent";
            
        } else {
      
            $processedCounter = 0;
            
            foreach ($this->CostFormItems as $cfi) {
                if ($cfi->is_Processed == true) $processedCounter++;
            }
            
            if ($processedCounter == 0) return "Sent";
            elseif ($processedCounter == count($this->CostFormItems)) return "Processed";
            else return "Processing";
        }
    }
    
    public function getTotalSum() {
        
        $sum = 0;
        
        foreach ($this->CostFormItems as $cfi) {
            $sum += $cfi->amount;
        }
        
        return $sum;
    }
  
  
    public function deleteDraftForm() {
      
        $user = sfContext::getInstance()->getUser();
        $controller = sfContext::getInstance()->getController();
  
        if ( $this->isSent ) {
            
            $user->setFlash("error", sprintf("Cost form with id %d cannot be deleted because it is active!", $this->id ));
            
        } else {
      
            $user->setFlash("notice", sprintf("Cost form with id %d is deleted!", $this->id ));
            $this->setUpdatedBy($user->getGuardUser()->getId());
            $this->save();
            $this->delete();
            $controller->redirect($controller->genUrl('@costforms'));
            
        }
    }
}
