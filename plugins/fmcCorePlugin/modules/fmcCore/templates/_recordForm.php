<?php if (isset($title)) slot ('title', $title); ?>


<?php if (isset($activeClass)) slot('activeClass', $activeClass); ?>


<form method="post">

    <table class="table table-hover table-bordered table-condensed">
        
        <?php echo $form; ?>
        
    </table>

    <div class="form-actions">
        
        <a class="btn" href="<?php echo $back_url; ?>">Back to List</a>
        
        <input class="btn btn-primary" type="submit" value="Save" />
        
        <?php if (!$form->isNew()): ?>
            <input class="btn pull-right" type="reset" value="Revert Changes" />
        <?php endif; ?>
        
    </div>

</form>
