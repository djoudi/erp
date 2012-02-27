<?php slot ('title', "My Cost Forms") ?>

<?php if (isset($filterForm)): ?>
  <?php include_partial ('fmcCore/filterForm', array('filter'=>$filterForm, 'filtered'=>$filtered)); ?>
<?php endif; ?>
    
<?php if (!count($costForms)): ?>
  No cost forms found in your selected criterias.<br />
<?php else: ?>

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
