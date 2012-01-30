<?php slot ('title', "New Employee"); ?>

<form method="post" action="">

  <table class="bordered-table zebra-striped">
    <?php echo $form; ?>
  </table>

  <div class="actions">
    <a class="btn" href="<?php echo url_for("@employeeManagement"); ?>">Back to List</a>
    <input class="btn success" type="submit" value="Save" />
  </div>

</form>
