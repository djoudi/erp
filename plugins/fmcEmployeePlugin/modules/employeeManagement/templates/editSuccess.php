<?php slot ('title', "Employee: ".$item); ?>

<script type="text/javascript">
    $("#topmenu_settings").addClass("active");
</script>


<?php use_javascript('/sfFormExtraPlugin/js/double_list.js') ?>

<form method="post">

    <table class="table table-striped table-bordered table-condensed">
        <?php echo $form; ?>
    </table>

    <div class="form-actions">
        <a class="btn" href="<?php echo url_for("@employeeManagement"); ?>">Back to List</a>
        <input class="btn btn-success" type="submit" value="Save" />
    </div>

</form>
