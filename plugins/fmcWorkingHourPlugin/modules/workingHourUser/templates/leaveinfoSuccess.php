<?php include_partial ('title', array('date'=>$date, 'text'=>'Showing leave request')); ?>

<div class="well">
    You have an existing leave request. The details could be found below.
</div>

<div class="pull-right">
    <?php include_partial ('dateselector'); ?>
</div>

<table class="table table-bordered table-condensed">
    <tr>
        <th>Leave Date</th>
        <td><?php echo $leaveRequest->getDate(); ?></td>
    </tr>
    <tr>
        <th>Type</th>
        <td><?php echo $leaveStatus[$leaveRequest->getType()]; ?></td>
    </tr>
    <tr>
        <th>Description / Report Number</th>
        <td><?php echo $leaveRequest->getDescription(); ?></td>
    </tr>
    <tr>
        <th>Current Status</th>
        <td><?php echo $leaveRequest->getStatus(); ?></td>
    </tr>
    <tr>
        <th>Last Updated By</th>
        <td><?php echo $leaveRequest->getStatusUser(); ?></td>
    </tr>
</table>

<div class="clear"></div>

<div class="form-actions">
    
  <?php if ($leaveRequest->getStatus()=='Pending'): ?>
    <a class="btn" href="">Cancel Request</a>
  <?php endif; ?>
  
  <a class="btn btn-primary" href="">Print</a>
  
</div>
