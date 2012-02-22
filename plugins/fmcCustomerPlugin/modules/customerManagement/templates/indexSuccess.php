<?php slot ('title', "Customer List") ?>

<table class="tablesorter2a table table-striped table-bordered table-condensed">
  <thead>
    <tr>
      <th>No</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($customers as $customer): ?>
      <tr>
        <td><?php echo $customer->getId(); ?></td>
        <td><a href="<?php echo url_for("@customerManagement_edit?id=".$customer->getId()); ?>"><?php echo $customer->getName(); ?></a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
