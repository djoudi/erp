<?php
  $title = 'Working Hours for : ';
  $title .= date('Y-m-d, l', strtotime($date));
  
  
  
  if ($date == date('Y-m-d')) $title .= ' (Today)';
  elseif ($date == date('Y-m-d', strtotime('yesterday'))) $title .= ' (Yesterday)';
  elseif ($date == date('Y-m-d', strtotime('tomorrow'))) $title .= ' (Tomorrow)';
?>

<?php slot ('title', $title); ?>

<table class="table table-condensed">

  <thead>
    <tr>
      <th>Project</th>
      <th>From</th>
      <th>To</th>
      <th>Total</th>
      <th>Type of Work</th>
      <th>Comments</th>
      <th></th>
    </tr>
  </thead>
  
  <tbody>
    <?php foreach($items as $item): ?>
    <tr>
      <td><?php echo $item->getProject(); ?></td>
      <td><?php echo date("H:i", strtotime($item->getTimeStarted())); ?></td>
      <td><?php echo date("H:i", strtotime($item->getTimeFinished())); ?></td>
      <td><?php echo $item->getTimeDifference(); ?></td>
      <td><?php echo $item->getWorkType(); ?></td>
      <td><?php echo $item->getComment(); ?></td>
      <td></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
  
  <tfoot>
    <tr>
      <form action="" method="post">
        <?php echo $form->renderHiddenFields(); ?>
        <td><?php echo $form['project_id']; ?></td>
        <td id="time3"><?php echo $form['time_started']; ?></td>
        <td id="time4"><?php echo $form['time_finished']; ?></td>
        <td><span id="timetotal"></span></td>
        <td><?php echo $form['worktype_id']; ?></td>
        <td><?php echo $form['comment']; ?></td>
        <td><input class="btn btn-mini" type="submit" value="Add" /></td>
      </form>
    </tr>
  </tfoot>
  
</table>
