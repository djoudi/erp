<?php slot ('title', "New Department"); ?>

<?php use_javascript('/sfFormExtraPlugin/js/double_list.js') ?>

<form method="post" action="">

  <table class="table table-striped table-bordered table-condensed">
    <?php echo $form; ?>
  </table>

  <div class="form-actions">
    <a class="btn" href="<?php echo url_for("departmentManagement_list"); ?>">Back to List</a>
    <input class="btn btn-success" type="submit" value="Save" />
  </div>

</form>
