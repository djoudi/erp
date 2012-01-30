<?php slot ('title', "Create new cost form") ?>

<form action="" method="post">

  <?php echo $form->renderHiddenFields() ?>
  
  <table class="bordered-table">
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

  <div class="actions">
    <a class="btn" href="javascript:history.back(1)" >Cancel</a>
    <input type="submit" class="btn success" value="Save and Continue"></input>
  </div>
  
</form>
