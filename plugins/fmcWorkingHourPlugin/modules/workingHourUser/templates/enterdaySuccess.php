<?php slot ('title', "Enter office entrance") ?>


<form action="" method="post">
  
  <?php echo $form->renderHiddenFields(); ?>
  
  <table class="table table-striped table-bordered table-condensed">
    <tr>
      <th><?php echo $form['time']->renderLabel(); ?></th>
      <td><?php echo $form['time']; ?></td>
    </tr>  
  </table>

  <div class="form-actions">
    <a class="btn" href="javascript:history.back(1)" >Cancel</a>
    <input type="submit" class="btn btn-success" value="Save and Continue"></input>
  </div>
  
</form>
