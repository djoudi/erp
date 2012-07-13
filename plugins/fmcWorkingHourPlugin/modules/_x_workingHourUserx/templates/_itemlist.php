<?php if (!count($items)): ?>

  <p>No records found</p>

<?php else: ?>

  <table class="table table-bordered table-condensed">
    
    <thead>
      <tr>
        <th>Project</th>
        <th>Time</th>
        <th>Type of Work</th>
        <th>Comments</th>
      </tr>
    </thead>
    
    <tbody>
      
      <?php foreach($items as $item): ?>
        <tr>
          <td><?php echo $item->getProject(); ?></td>
          <td><?php #echo $item->getTime(); ?></td>
          <td><?php echo $item->getWorkType(); ?></td>
          <td><?php echo $item->getComment(); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
    
  </table>
  
<?php endif; ?>
