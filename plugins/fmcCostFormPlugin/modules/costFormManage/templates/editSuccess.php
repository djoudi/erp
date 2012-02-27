<?php slot ('title', "Edit Cost") ?>

<form action="" method="post">

  <table class="table table-striped table-bordered table-condensed">
    <?php echo $form; ?>
    
    <tr>
      <td>Created</td>
      <td>
        <?php echo $cost->getCreatedAt(); ?>
        <?php if ($cost->getCreator()->getId()): ?>
           by <?php echo $cost->getCreator(); ?>
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td>Last Edited</td>
      <td>
        <?php echo $cost->getUpdatedAt(); ?>
        <?php if ($cost->getUpdater()->getId()): ?>
           by <?php echo $cost->getUpdater(); ?>
        <?php endif; ?>
      </td>
    </tr>
  </table>
  
  <div class="form-actions">
    <a class="btn" href="<?php echo url_for('@costFormReport_index'); ?>">Go Back to Reporting</a>
    <input class="btn btn-success" type="submit" value="Save" />
  </div>

</form>
