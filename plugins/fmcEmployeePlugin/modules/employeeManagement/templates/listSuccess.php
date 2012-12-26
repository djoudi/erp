<?php slot ('title', "Employee List") ?>


<?php slot ('activeClass', "#topmenu_settings"); ?>


<p>
    <a class="btn btn-primary" href="<?php echo url_for('employeeManagement_new'); ?>">
        New Employee
    </a>
</p>


<p>
    <strong>Quick find : </strong>
    
    <input class="employeeTypeahead" type="text" class="span3" data-provide="typeahead" data-items="4">
    
    <script>
    $(':input.employeeTypeahead').typeahead(
    {
        source: function(query, process)
        {
            objects = [];
            map = {};
            var data = [
                <?php foreach ($items as $item): ?>
                    {
                        "id" : <?php echo $item['id']; ?> , 
                        "label" : "<?php echo $item["first_name"]." ".$item['last_name']; ?>"
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
            var url = "<?php echo url_for('@employeeManagement_edit?id='); ?>" + map[item].id;
            $('.employeeType').val("");
            window.location = url;
        }
    }); 
    </script>
    
</p>


<?php if (!count($items)): ?>

    <p>No records found.</p>

<?php else: ?>

    <table class="tablesorter2a table table-hover table-condensed table-bordered">
        <thead>
            <tr>
                <th>Active</th>
                <th>Name</th>
                <th>Email</th>
                <th>Title</th>
                <th>Department</th>
                <th>Username</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $employee): ?>
                <tr>
                    <td>
                        <?php if ($employee["is_active"]): ?>
                            <i class="icon-ok"></i>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo url_for("@employeeManagement_edit?id=".$employee["id"]); ?>">
                            <?php echo $employee["first_name"]; ?> <?php echo $employee["last_name"]; ?>
                        </a>
                    </td>
                    <td>
                        <?php echo $employee["email_address"]; ?>
                    </td>
                    <td>
                        <?php echo $employee["title"]; ?>
                    </td>
                    <td>
                        <?php echo $employee["Department"]["name"]; ?>
                    </td>
                    <td>
                        <?php echo $employee["username"]; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>
