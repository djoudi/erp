<?php slot ('title', "Edit Cost") ?>


<?php slot ('activeClass', "#topmenu_costforms"); ?>


<form action="" method="post">

    <table class="table table-hover table-bordered table-condensed">
        
        <?php echo $form; ?>
        
    </table>
  
    <div class="form-actions">
        
        <a class="btn" href="<?php echo url_for('@costFormReport_index'); ?>">Go Back to Reporting</a>
        <input class="btn btn-success" type="submit" value="Save" />
        
        <a 
            class="btn btn-info pull-right" 
            href="<?php echo url_for('costFormManage_costform',array('id'=>$cost['costForm_id'])); ?>"
        >Show Cost Form</a>
        
    </div>

</form>
