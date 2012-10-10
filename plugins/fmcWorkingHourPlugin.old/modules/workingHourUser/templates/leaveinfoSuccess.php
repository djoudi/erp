<?php include_partial ('title', array('date'=>$date, 'text'=>'Showing leave request')); ?>

<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>


<div class="pull-right">
    <?php include_partial ('dateselector'); ?>
</div>


<?php include_partial ('leaveinfo', array('leaveRequest'=>$leaveRequest, 'leaveStatus'=>$leaveStatus)); ?>


<div class="clear"></div>


<div class="form-actions">
    
    <?php if ($leaveRequest ['status'] =='Pending'): ?>
        <a class="btn btn-danger pull-right" onclick="
          if (confirm('Are you sure you want to cancel this leave request?'))
            parent.location='<?php echo $cancelUrl; ?>'
        ">Cancel Request</a>
    <?php endif; ?>
  
    <div class="clear"></div>
  
</div>
