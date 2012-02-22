<?php slot ('title', "Invoicing Employee Cost Forms") ?>

<p>Please select a project to show the unprocessed costs</p>

<form method="post" action="">

  <table class="table table-striped table-bordered table-condensed">
  
    <tr>
      <th>Status</th>
      <td>Not invoiced</td>
    </tr>
    
    <tr>
      <th>Project</th>
      <td>
        <select name="projects">
          <option value="">Select Project</option>
          <?php foreach ($projectList as $project): ?>
            <option value="<?php echo $project->id ?>"><?php echo $project ?></option>
          <?php endforeach;?>
        </select>
      </td>
    </tr>
    
    <tr>
      <td></td>
      <td><input class="btn btn-info pull-right" type="submit" value="Select" /></td>
    </tr>
    
  </table>
  
</form>
