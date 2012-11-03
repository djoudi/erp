<?php slot ('title', "New Department"); ?>


<script type="text/javascript">
    $("#topmenu_settings").addClass("active");
</script>


<?php include_partial('fmcCore/recordForm', array(
    'form' => $form,
    'back_url' => url_for("@departmentManagement_list")
)); ?>
