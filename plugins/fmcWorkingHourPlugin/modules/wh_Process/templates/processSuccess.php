<?php slot ('title', "Processing leave request"); ?>

<?php include_partial ('workingHourUser/leaveinfo', array('leaveRequest'=>$leave, 'leaveStatus'=>$leaveStatus)); ?>

<div class="clear"></div>

<div class="form-actions">
    
    <?php if ($leave ['status'] =='Pending'): ?>
        <a class="btn btn-success" onclick="
          if (confirm('Are you sure you want to approve this leave request?'))
            parent.location='<?php echo $approveUrl; ?>'
        ">Approve Request</a>
        
        <a class="btn btn-danger" onclick="
          if (confirm('Are you sure you want to deny this leave request?'))
            parent.location='<?php echo $denyUrl; ?>'
        ">Deny Request</a>
        
    <?php endif; ?>
  
    <div class="clear"></div>
  
</div>
