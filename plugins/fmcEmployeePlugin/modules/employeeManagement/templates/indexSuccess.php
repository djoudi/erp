<?php slot ('title', "Employee List") ?>

<p>
  <a class="btn btn-primary" href="<?php echo url_for('employeeManagement_new'); ?>">New employee</a>
</p>

<?php if (isset($filter)): ?>
  <?php include_partial ('fmcCore/filterForm', array(
  'filter'=>$filter, 
  'filtered'=>$filtered, 
  'count'=>count($employees)
  )); ?>
<?php endif; ?>

<table class="tablesorter2a tablesorterpager table table-striped table-bordered table-condensed">
  <thead>
    <tr>
      <th>Active</th>
      <th>Name</th>
      <th>Email</th>
      <th>Title</th>
      <th>Username</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($employees as $employee): ?>
      <tr>
        <td><?php if ($employee->getIsActive()): ?><img src="/images/tick.png" /><?php endif; ?></td>
        <td><a href="<?php echo url_for("@employeeManagement_edit?id=".$employee->getId()); ?>"><?php echo $employee->getName(); ?></a></td>
        <td><?php echo $employee->getEmailAddress(); ?></td>
        <td><?php echo $employee->getTitle(); ?></td>
        <td><?php echo $employee->getUsername(); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
