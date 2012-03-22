<?php slot ('title', "Departments List") ?>

<p>
  <a class="btn btn-primary" href="<?php echo url_for('departmentManagement_new'); ?>">New department</a>
</p>

<?php if (isset($filter)): ?>
  <?php include_partial ('fmcCore/filterForm', array(
  'filter'=>$filter, 
  'filtered'=>$filtered, 
  'count'=>count($items)
  )); ?>
<?php endif; ?>

<?php if (count($items)): ?>

  <table class="tablesorter2a tablesorterpager table table-striped table-bordered table-condensed">
    <thead>
      <tr>
        <th>Name</th>
        <th>Manager</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($items as $item): ?>
        <tr>
          <td>
            <a href="<?php echo url_for('departmentManagement_edit', array('id'=>$item->getId())); ?>">
              <?php echo $item->getName(); ?>
            </a>
          </td>
          <td>
            <?php echo $item->getManager(); ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

<?php endif; ?>
