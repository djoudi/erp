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
    <form action="<?php echo url_for('customer_search') ?>" method="get">
        <strong>Quick filter : </strong>
        <input 
            type="text" 
            name="query" 
            id="ajax_input" 
            value="<?php echo $sf_request->getParameter('query'); ?>" 
        />
        <input id="ajax_submit" type="submit" value="search" />
  </form>
</div>


<div id="ajax_content">
    <?php include_partial ('items', array('items'=>$customers)); ?>
</div>
