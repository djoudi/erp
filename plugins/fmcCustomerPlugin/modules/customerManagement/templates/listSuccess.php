<?php slot ('title', "Customer List") ?>


<?php slot ('activeClass', "#topmenu_settings"); ?>


<p>
    <strong>Quick find : </strong>
    
    <?php include_partial ('fmcCore/typeahead', array(
        'items' => $customers,
        'url' => '@customerManagement_edit?id=',
        'class' => "customerTypeahead",
        'col1' => 'name'
    )); ?>
    
</p>


<?php if (isset($filter)): ?>
    <?php include_partial ('fmcCore/filterForm', array(
        'filter'=>$filter, 
        'filtered'=>$filtered, 
        'count'=>count($customers),
        'new_url'=>url_for('@customerManagement_new'),
        'new_text'=>"New Customer"
    )); ?>
<?php endif; ?>


<?php if (count($customers)): ?>
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
<?php endif; ?>
