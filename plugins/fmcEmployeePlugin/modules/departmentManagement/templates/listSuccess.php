<p>
  <a class="btn btn-primary" href="<?php echo url_for('departmentManagement_new'); ?>">New department</a>
</p>

<?php slot ('title', "Departments List") ?>

<?php if (isset($filter)): ?>
  <?php include_partial ('fmcCore/filterForm', array(
  'filter'=>$filter, 
  'filtered'=>$filtered, 
  'count'=>count($items)
  )); ?>
<?php endif; ?>

<table class="tablesorter2a tablesorterpager table table-striped table-bordered table-condensed">
  <thead>
    <tr>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($items as $item): ?>
      <tr>
        <td><?php echo $item->getName(); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
