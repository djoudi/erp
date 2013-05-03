<?php
    slot ('title', "My Working Hour Reports");
    slot ('activeClass', "#topmenu_workinghours");
?>


<div class="alert alert-info clearfix" style="text-align: center;">

    <?php if ($prevMonth): ?>
        <a href="<?php echo url_for("wh_user_reports-bydate")."?month={$prevMonth}"; ?>" class="btn pull-left">
            <i class="icon-chevron-left"></i> <?php echo $prevMonth; ?>
        </a>
    <?php endif; ?>

    <?php if ($nextMonth): ?>
        <a href="<?php echo url_for("wh_user_reports-bydate")."?month={$nextMonth}"; ?>" class="btn pull-right">
            <i class="icon-chevron-right"></i> <?php echo $nextMonth; ?>
        </a>
    <?php endif; ?>
    
    
    
    
    Working Hour Records for: 
        <span class="label label-success">
            <strong><?php echo $employee; ?></strong>
        </span>
    <br />
    
    <span class="label label-info">
        <?php echo $startDate; ?> - <?php  echo $endDate; ?>
    </span>
    <br />
    
    <span class="label label-warning"> Balance before <strong><?php echo $startDate; ?> : </strong> 
    <?php echo Fmc_Core_Time::getTimeEasy($lastBalance*60); ?></span>


    
    <div class="clearfix"></div>
    
</div>


<?php include_partial ("workAll", array(
    "startDate" => $startDate,
    "endDate" => $endDate,
    "results" => $results
)); ?>
