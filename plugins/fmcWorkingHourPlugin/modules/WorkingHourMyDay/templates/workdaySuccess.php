<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<div class="row">

    <div class="span3">
        
        <h5><?php echo Fmc_Wh_Day::getGoodDate ($date); ?></h5>
        
        <?php include_partial ('datepicker', array('date'=>$date)); ?>
        
        <hr />
            
        <?php include_partial ('day_info_general', array('day'=>$day)); ?>
            
        <?php if ($day['status']=="Draft"): ?>
            <?php include_partial ('day_draft_options', array('day'=>$day)); ?>
        <?php endif; ?>
        
    </div>
    
    <div class="span9" style="padding-top: 20px">

        içerik
    
    </div><!-- .span8 -->

</div><!-- .row -->
