<?php slot ('title', "Employee: ".$employee->__toString()); ?>


<form method="post" action="">

  <table class="bordered-table zebra-striped labeltable">
    <?php echo $form; ?>
  </table>

  <div class="actions">
    <a class="btn" href="<?php echo url_for("@employeeManagement"); ?>">Back to List</a>
    <input class="btn success" type="submit" value="Save" />
  </div>

</form>
