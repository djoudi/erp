<?php slot('title', 'Create new leave request'); ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<div class="row">
    
    <?php include_partial ('datepicker'); ?>
        
    <div class="span8" style="padding-top: 40px">
        
        <?php include_partial ('leaveoptions', array('leaveTypes'=>$leaveTypes)); ?>
        
    </div><!-- .span8 -->
    
</div><!-- .row -->
