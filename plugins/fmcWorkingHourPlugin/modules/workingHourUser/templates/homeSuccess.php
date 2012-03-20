<?php slot ('title', 'My working hours'); ?>

<div class="row">
  
  <div class="span8">
    
    <h4>Today</h4>
    
    <?php if (!count($todayItems)): ?>
      <p>You don't have any records for today.</p>
    <?php else: ?>
      <table class="table table-bordered table-condensed">
        <tr>
          <th>Project</th>
          <th>Time</th>
          <th>Type of Work</th>
          <th>Comments</th>
        </tr>
        <?php foreach($todayItems as $item): ?>
          <tr>
            <td><?php echo $item->getProject(); ?></td>
            <td><?php #echo $item->getTime(); ?></td>
            <td><?php echo $item->getWorkType(); ?></td>
            <td><?php echo $item->getComment(); ?></td>
          </tr>
        
        <?php endforeach; ?>
      </table>
    <?php endif; ?>
    <a href="<?php echo url_for('workingHourUser_edit', array('date'=>date('Y-m-d'))); ?>">
      Go to today
    </a>
  </div>

  <div class="span2">
    select date

<input id="datepick_whdb_url" type="hidden" value="<?php echo url_for('@workingHourUser_edit?date='); ?>" />
Date: <div id="datepick_whdb"></div>




    
  </div>

</div>
