<?php include_partial ('title', array('date'=>$date)); ?>

<form method='post' action=''>

  <?php echo $form->renderHiddenFields(); ?>
  <strong>Office exit</strong>
  <?php echo $form["end"]; ?>
  
  <input class="btn btn-primary" type="submit" value="Save" />
  
</form>
