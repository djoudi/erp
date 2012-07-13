<?php include_partial ('title', array('date'=>$date)); ?>

<form method='post' action='<?php echo url_for('@workingHourUser_editday_enterance?date='.$date); ?>'>

  <?php echo $form->renderHiddenFields(); ?>
  <strong>Office enterance</strong>
  <?php echo $form["start"]; ?>
  
  <input class="btn btn-primary" type="submit" value="Save" />
  
</form>

