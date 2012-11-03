<?php slot ('title', "Employee: ".$item); ?>

<script type="text/javascript">
    $("#topmenu_settings").addClass("active");
</script>


<?php use_javascript('/sfFormExtraPlugin/js/double_list.js') ?>


<form method="post" class="form-horizontal">

    <table class="table table-hover table-condensed table-bordered">
        <?php echo $form; ?>
    </table>

    <div class="form-actions">
        <a class="btn" href="<?php echo url_for("@employeeManagement"); ?>">Back to List</a>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>

</form>
