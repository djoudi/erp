<?php include_partial ('title', array('date'=>$date, 'text'=>'Showing leave request')); ?>


<div class="well">
    You have an existing leave request. The details could be found below.
</div>


<div class="pull-right">
    <?php include_partial ('dateselector'); ?>
</div>

<?php include_partial ('leaveinfo', array('leaveRequest'=>$leaveRequest, 'leaveStatus'=>$leaveStatus)); ?>


<div class="clear"></div>

<div class="form-actions">
    
    <?php if ($leaveRequest->getStatus()=='Pending'): ?>
        <a class="btn btn-danger pull-right" onclick="
          if (confirm('Are you sure you want to cancel this leave request?'))
            parent.location='<?php echo $cancelUrl; ?>'
        ">Cancel Request</a>
    <?php endif; ?>
  
    <div class="clear"></div>
  
</div>
