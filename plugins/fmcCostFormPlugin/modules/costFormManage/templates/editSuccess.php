<?php slot ('title', "Edit Cost") ?>

<form action="" method="post">

  <table class="table table-striped table-bordered table-condensed">
    <?php echo $form; ?>
  </table>
  
  <div class="form-actions">
    <a class="btn" href="<?php echo url_for('@costFormReport_index'); ?>">Go Back to Reporting</a>
    <input class="btn btn-success" type="submit" value="Save" />
  </div>

</form>
