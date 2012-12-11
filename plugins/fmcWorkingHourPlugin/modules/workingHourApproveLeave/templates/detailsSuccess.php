<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>


<h4>Showing Leave Details</h4>

<table class="table table-bordered table-condensed table-hover">
    <tr>
        <th>Request No</th>
        <td>
            <?php echo $item['id']; ?>
        </td>
    </tr>
    <tr>
        <th>Employee</th>
        <td>
            <?php echo $item->getEmployee(); ?>
        </td>
    </tr>
    <tr>
        <th>Leave Type</th>
        <td>
            <?php echo $item->getLeaveType(); ?>
        </td>
    </tr>
    <tr>
        <th>Start Date</th>
        <td>
            <?php echo $item['start_Date']; ?>
        </td>
    </tr>
    <tr>
        <th>End Date</th>
        <td>
            <?php echo $item['end_Date']; ?>
        </td>
    </tr>
    <tr>
        <th>Number of days</th>
        <td>
            <?php echo $item['day_Count']; ?>
        </td>
    </tr>
</table>


<?php if ($item['LeaveType']['has_Report']): ?>
    <table class="table table-bordered table-condensed table-hover">
        <tr>
            <th>Report Date</th>
            <td><?php echo $item['report_Date']; ?></td>
        </tr>
        
        <tr>
            <th>Report Number</th>
            <td><?php echo $item['report_Number']; ?></td>
        </tr>
        
        <tr>
            <th>Report Receive Date</th>
            <td>
                <?php if ($item['report_Received']): ?>
                    <?php echo $item['report_Received']; ?>
                <?php else: ?>
                    Not Received
                <?php endif; ?>
            </td>
        </tr>
    </table>
<?php endif; ?>


<div class="form-actions">

    <a class="btn" href="javascript:history.back()">Go Back</a>
    
    <?php if ($sf_user->hasCredential ('Working Hours Leave Approve') && $item['status']=="Pending"): ?>
    
        <div class="pull-right">
    
            <?php include_partial ('fmcCore/confirmButton', array(
                'class' => 'btn btn-danger btn-small',
                'url' => url_for('workingHourApproveLeave_deny',array('id'=>$item['id'])),
                'label' => 'Deny (Remove)',
                'text' => 'Are you sure you want to deny and delete this leave?',
                "iconClass" => 'icon-remove icon-white'
            )); ?>
            
            <?php include_partial ('fmcCore/confirmButton', array(
                'class' => 'btn btn-success btn-small',
                'url' => url_for('workingHourApproveLeave_approve',array('id'=>$item['id'])),
                'label' => 'Approve',
                'text' => 'Are you sure you want to approve this leave?',
                "iconClass" => 'icon-ok icon-white'
            )); ?>
        
        </div>
        
    <?php endif; ?>
    
</div>
