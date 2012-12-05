<?php slot ('title', "Create new cost form") ?>

<script type="text/javascript">
    $("#topmenu_costforms").addClass("active");
</script>

<form method="post">

  <?php echo $form->renderHiddenFields() ?>
  
  <table class="table table-striped table-bordered table-condensed">
    <tr>
      <th>Project</th>
      <td><?php echo $form['project_id'] ?></td>
    </tr>
    <tr>
      <th>Received Advance</th>
      <td>
        <?php echo $form['advanceRecieved'] ?>
        <?php echo $form['currency_id'] ?>
      </td>
    </tr>
  </table>
  
  <p class="muted">
      Note: If you did not receive any advances, you can keep <strong>Received Advance</strong> field blank.
  </p>
  
  <div class="form-actions">
    <a class="btn" href="javascript:history.back(1)" >Cancel</a>
    <input type="submit" class="btn btn-success" value="Save and Continue"></input>
  </div>
  
</form>
