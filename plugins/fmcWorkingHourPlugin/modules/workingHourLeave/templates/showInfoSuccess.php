<?php slot('title', 'Showing leave request details' ); ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<div class="row">

    <div class="span3">
        <h5><?php echo whDayInfo::getGoodDate ($date); ?></h5>
        <?php include_partial ('workingHourDay/datepicker', array('date'=>$date)); ?>
    </div>
    
    <div class="span9" style="padding-top: 20px">

        <?php include_partial ('leaveInfo',array('leaveRequest'=>$leaveRequest)); ?>

    </div><!-- .span9 -->

</div><!-- .row -->
