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


<table class="tablesorter tablesorterpager table table-hover table-bordered table-condensed">
    <thead>
        <tr>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($customers as $item): ?>
            <tr>
                <td>
                    <a href="<?php echo url_for('@customerManagement_edit?id='.$item["id"]); ?>">
                        <?php echo $item->getName(); ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
