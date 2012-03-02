<?php slot ('title', "My Cost Forms") ?>

<?php if (isset($filter)): ?>
  <?php include_partial ('fmcCore/filterForm', array('filter'=>$filter, 'filtered'=>$filtered)); ?>
<?php endif; ?>

<?php if (!count($costForms)): ?>
  <p>No cost forms found in your selected criterias.</p>
<?php else: ?>

  <p><strong><?php echo count($costForms); ?></strong> cost forms found.</p>
  
  <table class="tablesorter table table-striped table-bordered table-condensed">
    <thead>
      <tr>
        <th>CF No</th>
        <th>Project</th>
        <th>Advances</th>
        <th>Date Created</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($costForms as $cf): ?>
        <tr>
           <td><?php echo $cf->id ?></td>
           <td><a href="<?php echo url_for("@costFormUser_edit?id=".$cf->id); ?>"><?php echo $cf->Projects ?></a></td>
           <td><?php echo $cf->advanceRecieved ? $cf->advanceRecieved.' TL' : '-' ?></td>
           <td><?php echo date ("Y-m-d H:m", strtotime($cf->created_at)); ?></td>
           <td><?php echo $costFormStatus[$cf->totalStatus] ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  
<?php endif; ?>
