<?php slot ('title', "Customer List") ?>



<?php slot ('activeClass', "#topmenu_settings"); ?>



<p>
    <strong>Quick find : </strong>
    
    <input class="customerTypeahead" type="text" class="span3" data-provide="typeahead" data-items="10">
    
    <script>
    $(':input.customerTypeahead').typeahead(
    {
        source: function(query, process)
        {
            objects = [];
            map = {};
            var data = [
                <?php foreach ($customers as $item): ?>
                    {
                        "id" : <?php echo $item['id']; ?> , 
                        "label" : "<?php echo $item["name"]; ?>"
                    },
                <?php endforeach; ?>
            ];
            $.each(data, function(i, object)
            {
                map[object.label] = object;
                objects.push(object.label);
            });
            process(objects);
        },
        updater: function(item)
        {
            var url = "<?php echo url_for('@customerManagement_edit?id='); ?>" + map[item].id;
            $('.customerTypeahead').val("");
            window.location = url;
        }
    }); 
    </script>
    
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
