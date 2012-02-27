<?php slot ('title', "Customer: ".$customer->getName()); ?>

<form method="post" action="">

  <table class="table table-striped table-bordered table-condensed">
    <?php echo $form; ?>
    
    <tr>
      <td>Created</td>
      <td>
        <?php echo $customer->getCreatedAt(); ?>
        <?php if ($customer->getCreator()->getId()): ?>
           by <?php echo $customer->getCreator(); ?>
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td>Last Edited</td>
      <td>
        <?php echo $customer->getUpdatedAt(); ?>
        <?php if ($customer->getUpdater()->getId()): ?>
           by <?php echo $customer->getUpdater(); ?>
        <?php endif; ?>
      </td>
    </tr>
    
  </table>

  <div class="form-actions">
    <a class="btn" href="<?php echo url_for("@customerManagement"); ?>">Back to List</a>
    <input class="btn btn-success" type="submit" value="Save" />
  </div>

</form>
