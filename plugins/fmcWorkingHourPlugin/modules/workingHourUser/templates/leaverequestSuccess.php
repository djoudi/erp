<?php include_partial ('title', array('date'=>$date, 'text'=>$leaveStatus[$type])); ?>

<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>


<form method="post" action="">

    <?php echo $form->renderHiddenFields(); ?>
    
    <table class="table table-striped table-bordered table-condensed">
        <tr>
            <td>
                <?php echo $type=="IllnessWReport" ? "Report Information" : $form['description']->renderLabel(); ?>
            </td>
            <td>
                <?php echo $form['description']; ?>
            </td>
        </tr>
        <tr>
            <td>From</td>
            <td><?php echo $form['from_Date']; ?></td>
        </tr>
        <tr>
            <td>To</td>
            <td><?php echo $form['to_Date']; ?></td>
        </tr>
    </table>

    <div class="form-actions">
      
        <a class="btn" href="<?php echo url_for('workingHourUser_day', array('date'=>$date)); ?>">Back to the day</a>
        
        <input class="btn btn-success" type="submit" value="Send Request" />
    
    </div>

</form>
