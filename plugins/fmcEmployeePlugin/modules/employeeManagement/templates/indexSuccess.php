<?php slot ('title', "Employee List") ?>


<table class="tablesorter zebra-striped bordered-table">
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

