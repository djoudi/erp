<?php
    slot ('title', "My Working Hour Reports");
    slot ('activeClass', "#topmenu_workinghours");
?>


<div class="alert alert-info">
  
  Balance before <strong><?php echo $startDate; ?> : </strong> 
  <span class="label label-warning"><?php echo Fmc_Core_Time::getTimeEasy($lastBalance*60); ?></span>
  
</div>


<table class="table table-bordered table-condensed table-hover">
    <thead>
        <tr>
            <th>Date</th>
            <th>Type</th>
            <th>Multiplier</th>
            <th>Must work minutes</th>
            <th>Worked minutes</th>
            <th>Work balance</th>
            <th>Used breaks</th>
            <th>Breaks balance</th>
            <th>Day balance</th>
            <th>Total balance</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php foreach ($results as $result): ?>
                
                <?php $dayObject = new DateTime ($result["date"]); ?>
                
                <?php if ($dayObject->format("j") == 1): ?>
                    <tr>
                        <th colspan="10" style="text-align: center;"><?php echo $dayObject->format("F"); ?></th>
                    </tr>
                <?php endif; ?>
                <tr>
                
                    <td>
                        <?php echo $result["date"]; ?>
                    </td>

                    <td>
                        <?php echo $result["type"]; ?>
                    </td>
                    
                    <td>
                        <?php if ($result["type"]=="Work"): ?>
                            <?php echo number_format($result["multiplier"], 2, '.', ''); ?>
                        <?php endif; ?>
                    </td>
                    
                    <td>
                        <?php if ($result["minutesToWork"]): ?>
                            <?php echo Fmc_Core_Time::getTimeEasy($result["minutesToWork"]*60); ?>
                        <?php endif; ?>
                    </td>
                    
                    <td>
                        <?php if ($result["workedMinutes"]): ?>
                            <?php echo Fmc_Core_Time::getTimeEasy($result["workedMinutes"]*60); ?>
                        <?php endif; ?>
                    </td>
                    
                    <td>
                        <?php if ($result["workBalance"]): ?>
                            <?php echo Fmc_Core_Time::getTimeEasy($result["workBalance"]*60); ?>
                        <?php endif; ?>
                    </td>
                    
                    <td>
                        
                        <?php if ($result["usedBreaks"]): ?>
                            <?php echo Fmc_Core_Time::getTimeEasy($result["usedBreaks"]*60); ?>
                        <?php endif; ?>
                    </td>
                    
                    <td>
                        <?php if ($result["breaksBalance"]): ?>
                            <?php echo Fmc_Core_Time::getTimeEasy($result["breaksBalance"]*60); ?>
                        <?php endif; ?>
                    </td>
                    
                    <td>
                        <?php if ($result["dayBalance"]): ?>
                            <?php echo Fmc_Core_Time::getTimeEasy($result["dayBalance"]*60); ?>
                        <?php endif; ?>
                    </td>
                    
                    <td>
                        <?php echo Fmc_Core_Time::getTimeEasy($result["balanceAfterThisday"]*60, false); ?>
                    </td>
                    
                </tr>
                
            <?php endforeach; ?>
        </tr>
    </tbody>
</table>
