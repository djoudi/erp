<?php include_partial ('title', array('date'=>$date, 'text'=>'Working Hours')); ?>


<?php if (!$leaveRequest): ?>

  <?php include_partial ('editdaylist', array('form'=>$form, 'items'=>$items, 'date'=>$date, 'leaveStatus'=>$leaveStatus)); ?>
  
<?php else: ?>

  <div class="alert alert-block">
    You already have an existing leave request. The details could be found below.
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
      <th>Report Date</th>
      <td><?php echo $leaveRequest->getReportDate(); ?></td>
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
  
<?php endif; ?>
