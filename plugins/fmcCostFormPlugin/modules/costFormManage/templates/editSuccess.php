<?php slot ('title', "Edit Cost") ?>

<form action="" method="post">

  <table class="zebra-striped bordered-table">
    <?php echo $form; ?>
  
  </table>
  <div class="actions">
    <a class="btn" href="<?php echo url_for('@costFormReport_index'); ?>">Go Back to Reporting</a>
    <input class="btn success" type="submit" value="Save" />
  </div>

</form>
