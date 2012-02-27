<?php slot ('title', "Employee: ".$employee->__toString()); ?>

<?php use_javascript('/sfFormExtraPlugin/js/double_list.js') ?>

<form method="post" action="">

  <table class="table table-striped table-bordered table-condensed">
    <?php echo $form; ?>
    
    <tr>
      <td>Created</td>
      <td>
        <?php echo $employee->getCreatedAt(); ?>
        <?php if ($employee->getCreator()->getId()): ?>
           by <?php echo $employee->getCreator(); ?>
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td>Last Edited</td>
      <td>
        <?php echo $employee->getUpdatedAt(); ?>
        <?php if ($employee->getUpdater()->getId()): ?>
           by <?php echo $employee->getUpdater(); ?>
        <?php endif; ?>
      </td>
    </tr>
    
  </table>

  <div class="form-actions">
    <a class="btn" href="<?php echo url_for("@employeeManagement"); ?>">Back to List</a>
    <input class="btn btn-success" type="submit" value="Save" />
  </div>

</form>
