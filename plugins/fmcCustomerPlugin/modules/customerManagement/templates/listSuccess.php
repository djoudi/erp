<?php slot ('title', "Customer List") ?>

<?php if (isset($filter)): ?>
  <?php include_partial ('fmcCore/filterForm', array('filter'=>$filter, 'filtered'=>$filtered)); ?>
<?php endif; ?>

<p><strong><?php echo count($customers); ?></strong> customers found.</p>

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
        <td><a href="<?php echo url_for('customerManagement_edit', array('id'=>$customer->getId())); ?>"><?php echo $customer->getName(); ?></a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
