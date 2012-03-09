<?php slot ('title', 'My working hours'); ?>

<div class="row">
  
  <div class="span9">
    
    <h4>Today</h4>
    
    <?php if (!count($todayItems)): ?>
      <p>You don't have any records for today.</p>
    <?php else: ?>
      <table class="table table-striped table-bordered table-condensed">
        <tr>
          <th>Project</th>
          <th>Time</th>
          <th>Type of Work</th>
          <th>Comments</th>
        </tr>
        <?php foreach($todayItems as $item): ?>
          <tr>
            <td><?php echo $item->getProject(); ?></td>
            <td><?php echo $item->getTime(); ?></td>
            <td><?php echo $item->getWorktype(); ?></td>
            <td><?php echo $item->getComment(); ?></td>
          </tr>
        
        <?php endforeach; ?>
      </table>
    <?php endif; ?>
  </div>

  <div class="span2">
    select date
  </div>

</div>

<hr />

<table class="table table-striped table-bordered table-condensed">
  <tr>
    <th>Employee</th>
    <td><?php echo $item->getUser(); ?></td>
  </tr>
  <tr>
    <th>Date</th>
    <td><?php echo $item->getDate(); ?></td>
  </tr>
</table>


<form action="" method="post">
  <?php echo $form; ?>
  <div class="form-actions">
    <input class="btn btn-primary" type="submit" value="Save" />
  </div>
</form>
