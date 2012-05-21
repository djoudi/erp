<?php include_partial ('title', array('date'=>$date, 'text'=>$leaveStatus[$type])); ?>

<form method="post" action="">

  <table class="table table-striped table-bordered table-condensed">
    <?php echo $form; ?>
  </table>

  <div class="form-actions">
    <a class="btn" href="<?php echo url_for('workingHourUser_editday', array('date'=>$date)); ?>">Back to the day</a>
    <input class="btn btn-success" type="submit" value="Send Request" />
  </div>

</form>
