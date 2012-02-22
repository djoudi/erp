<?php slot ('title', "Project List") ?>

<table class="tablesorter table table-striped table-bordered table-condensed">
  <thead>
    <tr>
      <th>P. No</th>
      <th>Status</th>
      <th>Customer</th>
      <th>Project Code</th>
      <th>Project Title</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($projects as $project): ?>
      <tr>
        <td><?php echo $project->getId(); ?></td>
        <td><?php echo $project->getStatus(); ?></td>
        <td><?php echo $project->getCustomers(); ?></td>
        <td><a href="<?php echo url_for("@projectManagement_edit?id=".$project->getId()); ?>"><?php echo $project->getCode(); ?></a></td>
        <td><?php echo $project->getTitle(); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
