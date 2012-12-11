<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>


<h4>Showing Day Details</h4>

<table class="table table-bordered table-condensed table-hover">
    <tr>
        <th>Employee</th>
        <td>
            <?php echo $day->getEmployee(); ?>
        </td>
    </tr>
    <tr>
        <th>Date</th>
        <td>
            <?php echo $day->getDate(); ?>
        </td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            <?php echo $day->getStatus(); ?>
        </td>
    </tr>
    <tr>
        <th>Multiplier</th>
        <td>
            <?php echo $day->getMultiplier(); ?>
        </td>
    </tr>    
</table>

<?php include_partial ('workingHourDay/dayitems',array(
    'dayRecords' => $day->getRecords(),
    'dayStatus' => $day->getStatus()
)); ?>


<div class="form-actions">

    <a class="btn" href="javascript:history.back()">Go Back</a>
    
    <?php if ($sf_user->hasCredential ('Working Hours Day Approve') && $day['status']=="Pending"): ?>
    
        <div class="pull-right">
    
            <?php include_partial ('fmcCore/confirmButton', array(
                'class' => 'btn btn-danger btn-small',
                'url' => url_for('workingHourApproveDay_deny',array('id'=>$day['id'])),
                'label' => 'Deny (Remove)',
                'text' => 'Are you sure you want to deny and delete this day?',
                "iconClass" => 'icon-remove icon-white'
            )); ?>
            
            <?php include_partial ('fmcCore/confirmButton', array(
                'class' => 'btn btn-success btn-small',
                'url' => url_for('workingHourApproveDay_approve',array('id'=>$day['id'])),
                'label' => 'Approve',
                'text' => 'Are you sure you want to approve this day?',
                "iconClass" => 'icon-ok icon-white'
            )); ?>
        
        </div>
        
    <?php endif; ?>
    
</div>
