<?php slot ('title', "Project List") ?>



<?php slot ('activeClass', "#topmenu_settings"); ?>



<p>
    <strong>Quick find : </strong>
    
    <input class="projectTypeahead" type="text" class="span3" data-provide="typeahead" data-items="10">
    
    <script>
    $(':input.projectTypeahead').typeahead(
    {
        source: function(query, process)
        {
            objects = [];
            map = {};
            var data = [
                <?php foreach ($items as $item): ?>
                    {
                        "id" : <?php echo $item['id']; ?> , 
                        "label" : "<?php 
                            echo $item["code"]; 
                            echo " (".$item["Customers"]["name"].")";
                            if ($item["title"]) echo " - ".$item["title"]; 
                        ?>"
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
            var url = "<?php echo url_for('@projectManagement_edit?id='); ?>" + map[item].id;
            $('.projectTypeahead').val("");
            window.location = url;
        }
    }); 
    </script>
    
</p>


<?php if (isset($filter)): ?>
    <?php include_partial ('fmcCore/filterForm', array(
        'filter'=>$filter, 
        'filtered'=>$filtered, 
        'count'=>count($items),
        'new_url'=>url_for('@projectManagement_new'),
        'new_text'=>"New Project"
    )); ?>
<?php endif; ?>


<table class="tablesorter3a table table-hover table-bordered table-condensed">
    <thead>
        <tr>
            <th>Status</th>
            <th>Customer</th>
            <th>Project Code</th>
            <th>Project Title</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $project): ?>
            <tr>
                <td>
                    <?php echo $project['status']; ?>
                </td>
                <td>
                    <?php echo $project->getCustomers(); ?>
                </td>
                <td>
                    <a href="<?php echo url_for("@projectManagement_edit?id=".$project['id']); ?>">
                        <?php echo $project->getCode(); ?>
                    </a>
                </td>
                <td>
                    <?php echo $project['title']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
