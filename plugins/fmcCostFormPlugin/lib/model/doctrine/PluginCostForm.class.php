<?php

abstract class PluginCostForm extends BaseCostForm
{
  public function getTotalStatus()
  {
    if ( ! $this->isSent )
    {
      return "NotSent";
    }
    else
    {
      $processedCounter = 0;
      foreach ($this->CostFormItems as $cfi)
      {
        if ($cfi->is_Processed == true) $processedCounter++;
      }
      if ($processedCounter == 0)
      {
        return "Sent";
      }
      elseif ($processedCounter == count($this->CostFormItems))
      {
        return "Processed";
      }
      else
      {
        return "Processing";
      }
    }
  }
  
  
  public function getTotalSum()
  {
    $sum = 0;
    foreach ($this->CostFormItems as $cfi)
    {
      $sum += $cfi->amount;
    }
    return $sum;
  }
}
