<?php slot('title', 'New Leave Request' ); ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<div class="row">

    <div class="span3">
        <h5><?php echo whDayInfo::getGoodDate ($date); ?></h5>
        <?php include_partial ('workingHourDay/datepicker', array('date'=>$date)); ?>
    </div>
    
    <div class="span9" style="padding-top: 20px">

        <?php include_component ('workingHourLeave', 'newRequest'); ?>

    </div><!-- .span9 -->

</div><!-- .row -->
