<?php slot ('title', "Work Type: ".$item->getTitle()); ?>

<form method="post" action="">

  <table class="table table-bordered table-condensed">
    <?php echo $form; ?>
    
    <tr>
      <td>Created</td>
      <td>
        <?php echo $item->getCreatedAt(); ?>
        <?php if ($item->getCreator()->getId()): ?>
           by <?php echo $item->getCreator(); ?>
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td>Last Edited</td>
      <td>
        <?php echo $item->getUpdatedAt(); ?>
        <?php if ($item->getUpdater()->getId()): ?>
           by <?php echo $item->getUpdater(); ?>
        <?php endif; ?>
      </td>
    </tr>
    
  </table>

  <div class="form-actions">
    <a class="btn" href="<?php echo url_for('workingHourWorkType_list'); ?>">Back to List</a>
    <input class="btn btn-success" type="submit" value="Save" />
  </div>

</form>
