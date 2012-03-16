<?php slot ('title', "Today's Working Hours"); ?>

<table class="table table-striped table-bordered table-condensed">

  <tr>
    <th>Project</th>
    <th>From</th>
    <th>To</th>
    <th>Total</th>
    <th>Type of Work</th>
    <th>Comments</th>
    <th></th>
  </tr>
  
  <?php foreach($todayItems as $item): ?>
  <tr>
    <td><?php echo $item->getProject(); ?></td>
    <td><?php echo date("H:i", strtotime($item->getTimeStarted())); ?></td>
    <td><?php echo date("H:i", strtotime($item->getTimeFinished())); ?></td>
    <td><?php echo $item->getTimeDifference(); ?></td>
    <td><?php echo $item->getWorktype(); ?></td>
    <td><?php echo $item->getComment(); ?></td>
    <td></td>
  </tr>
  <?php endforeach; ?>
  
  <tr>
    <form action="" method="post">
      <?php echo $form->renderHiddenFields(); ?>
      <td><?php echo $form['project_id']; ?></td>
      <td id="time3"><?php echo $form['time_started']; ?></td>
      <td id="time4"><?php echo $form['time_finished']; ?></td>
      <td><span id="timetotal"></span></td>
      <td><?php echo $form['worktype']; ?></td>
      <td><?php echo $form['comment']; ?></td>
      <td><input class="btn btn-mini" type="submit" value="Add" /></td>
    </form>
  </tr>
  
</table>
