<?php include_partial ('title', array('date'=>$date, 'text'=>'Day exit')); ?>

<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>


<form action="" method="post">
    
    <table class="table table-striped table-bordered table-condensed">
        <?php echo $form; ?>
    </table>
    
    <div class="form-actions">
        <a class="btn" href="javascript:history.back(1)" >Cancel</a>
        <input type="submit" class="btn btn-success" value="Save and Continue"></input>
    </div>

</form>
