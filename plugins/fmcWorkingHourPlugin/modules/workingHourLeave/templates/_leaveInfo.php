<table class="table table-bordered table-condensed table-hover">
    
    <tr>
        <th>Request Type</th>
        <td><?php echo $leaveRequest->getLeaveType(); ?></td>
    </tr>
    
    <tr>
        <th>Request No</th>
        <td><?php echo $leaveRequest['id']; ?></td>
    </tr>
    
    <tr>
        <th>Employee</th>
        <td><?php echo $leaveRequest->getEmployee(); ?></td>
    </tr>
    
    <tr>
        <th>Status</th>
        <td><?php echo $leaveRequest['status']; ?></td>
    </tr>
    
    <tr>
        <th>Start Date</th>
        <td><?php echo $leaveRequest['start_Date']; ?></td>
    </tr>
    
    <tr>
        <th>End Date</th>
        <td><?php echo $leaveRequest['end_Date']; ?></td>
    </tr>
    
    <tr>
        <th>Number of Days</th>
        <td><?php echo $leaveRequest['day_Count']; ?> day(s)</td>
    </tr>
    
    <tr>
        <th>Comment</th>
        <td><?php echo $leaveRequest['comment']; ?></td>
    </tr>
    
    <tr>
        <th>End Date</th>
        <td><?php echo $leaveRequest['end_Date']; ?></td>
    </tr>

</table>

<?php if ($leaveRequest['LeaveType']['has_Report']): ?>

    <table class="table table-bordered table-condensed table-hover">
        
        <tr>
            <th>Report Date</th>
            <td><?php echo $leaveRequest['report_Date']; ?></td>
        </tr>
        
        <tr>
            <th>Report Number</th>
            <td><?php echo $leaveRequest['report_Number']; ?></td>
        </tr>
        
        <tr>
            <th>Report Receive Date</th>
            <td>
                <?php if ($leaveRequest['report_Received']): ?>
                    <?php echo $leaveRequest['report_Received']; ?>
                <?php else: ?>
                    Not Received
                <?php endif; ?>
            </td>
        </tr>
        
    </table>

<?php endif; ?>


    <div class="form-actions">

        <a class="btn pull-left" href="<?php echo url_for('workingHourLeave_myRequests'); ?>">
            Show My Requests
        </a>
        
        <?php if ($leaveRequest['status']=="Pending"): ?>
        
            <div class="pull-right">
                <a class="btn btn-info" href="<?php echo url_for('workingHourLeave_exportExcel',array('id'=>$leaveRequest['id'])); ?>">
                    Export to Excel
                </a>
            </div>
        
        <?php endif; ?>
        
        
        <?php if ($leaveRequest['status']=="Draft"): ?>
        
            <div class="pull-right">
        
                <?php include_partial ('fmcCore/confirmButton', array(
                    'class' => 'btn btn-danger btn-small',
                    'url' => url_for('workingHourLeave_cancel',array('id'=>$leaveRequest['id'])),
                    'label' => 'Cancel Request',
                    'text' => 'Are you sure you want to cancel this leave request?',
                    "iconClass" => 'icon-remove icon-white'
                )); ?>
                
                <?php include_partial ('fmcCore/confirmButton', array(
                    'class' => 'btn btn-success btn-small',
                    'url' => url_for('workingHourLeave_send',array('id'=>$leaveRequest['id'])),
                    'label' => 'Send for Approve',
                    'text' => 'Are you sure you want to send this day for approval?',
                    "iconClass" => 'icon-ok icon-white'
                )); ?>
            
            </div>
            
        <?php endif; ?>
        
    </div>


