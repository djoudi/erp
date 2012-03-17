<?php slot ('title', "Work Types Management") ?>

<p>
  <a class="btn btn-primary" href="<?php echo url_for('@workingHourWorkType_new'); ?>">New Work Type</a>
</p>

<?php if (isset($filter)): ?>
  <?php include_partial ('fmcCore/filterForm', array(
  'filter'=>$filter, 
  'filtered'=>$filtered, 
  'count'=>count($items)
  )); ?>
<?php endif; ?>

<table class="tablesorter tablesorterpager table table-bordered table-condensed">
  <thead>
    <tr>
      <th>Title</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($items as $item): ?>
      <tr>
        <td>
          <a href="<?php echo url_for('workingHourWorkType_edit', array('id'=>$item->getId())); ?>">
            <?php echo $item->getTitle(); ?>
          </a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
