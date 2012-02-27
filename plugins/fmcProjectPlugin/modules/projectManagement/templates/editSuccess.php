<?php slot ('title', "Customer: ".$project->__toString()); ?>

<form method="post" action="">

  <table class="table table-striped table-bordered table-condensed">
    <?php echo $form; ?>
    
    <tr>
      <td>Created</td>
      <td>
        <?php echo $project->getCreatedAt(); ?>
        <?php if ($project->getCreator()->getId()): ?>
           by <?php echo $project->getCreator(); ?>
        <?php endif; ?>
      </td>
    </tr>
    <tr>
      <td>Last Edited</td>
      <td>
        <?php echo $project->getUpdatedAt(); ?>
        <?php if ($project->getUpdater()->getId()): ?>
           by <?php echo $project->getUpdater(); ?>
        <?php endif; ?>
      </td>
    </tr>
    
  </table>

  <div class="form-actions">
    <a class="btn" href="<?php echo url_for("@projectManagement"); ?>">Back to List</a>
    <input class="btn btn-success" type="submit" value="Save" />
  </div>

</form>

