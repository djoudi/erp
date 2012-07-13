<?php include_partial ('title', array('date'=>$date, 'text'=>'Working Hours')); ?>


<table class="table table-condensed table-bordered">  
  <tr>
    <th>Office entrance</th>
    <td><?php echo $entrance['time']; ?> </td>
  </tr>
</table>


<?php if (!$leaveRequest): ?>

  <?php include_partial ('editdaylist', array('form'=>$form, 'items'=>$items, 'date'=>$date, 'leaveStatus'=>$leaveStatus)); ?>
  
<?php else: ?>

  <?php include_partial ('editdayreport', array('leaveRequest'=>$leaveRequest, 'leaveStatus'=>$leaveStatus)); ?>
  
<?php endif; ?>
