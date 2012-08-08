<?php slot ('title', "Work Type: ".$item->getTitle()); ?>

<form method="post" action="">

    <table class="table table-bordered table-condensed">
        <?php echo $form; ?>
    </table>
    
    <div class="form-actions">
        <a class="btn" href="<?php echo url_for('workingHourWorkType_list'); ?>">Back to List</a>
        <input class="btn btn-success" type="submit" value="Save" />
    </div>

</form>
