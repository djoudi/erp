<?php slot ('title', "Customer List") ?>

<script type="text/javascript">
    $("#topmenu_settings").addClass("active");
</script>


<p>
  <a class="btn btn-primary" href="<?php echo url_for('customerManagement_new'); ?>">New customer</a>
</p>

<?php if (isset($filter)): ?>
  <?php include_partial ('fmcCore/filterForm', array(
  'filter'=>$filter, 
  'filtered'=>$filtered, 
  'count'=>count($customers)
  )); ?>
<?php endif; ?>

<table class="tablesorter tablesorterpager table table-striped table-bordered table-condensed">
  <thead>
    <tr>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($customers as $customer): ?>
      <tr>
        <td><a href="<?php echo url_for('customerManagement_edit', array('id'=>$customer->getId())); ?>"><?php echo $customer->getName(); ?></a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
