<?php slot ('title', "Customer List") ?>


<script type="text/javascript">
    $("#topmenu_settings").addClass("active");
</script>


<?php if (isset($filter)): ?>
    <?php include_partial ('fmcCore/filterForm', array(
        'filter'=>$filter, 
        'filtered'=>$filtered, 
        'count'=>count($customers),
        'new_url'=>url_for('@customerManagement_new'),
        'new_text'=>"New Customer"
    )); ?>
<?php endif; ?>


<div>
    <?php include_partial ('items', array('items'=>$customers)); ?>
</div>
