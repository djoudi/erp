<?php slot ('title', "Departments List") ?>

<script type="text/javascript">
    $("#topmenu_settings").addClass("active");
</script>


<?php if (isset($filter)): ?>
    <?php include_partial ('fmcCore/filterForm', array(
        'filter'=>$filter, 
        'filtered'=>$filtered, 
        'count'=>count($items),
        'new_url'=>url_for('@departmentManagement_new'),
        'new_text'=>"New Department"
    )); ?>
<?php endif; ?>



<?php if (count($items)): ?>

<table class="tablesorter2a tablesorterpager table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th>Name</th>
            <th>Manager</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td>
                    <a href="<?php echo url_for('@departmentManagement_edit?id='.$item["id"]); ?>">
                        <?php echo $item["name"]; ?>
                    </a>
                </td>
                <td>
                    <?php echo $item["Manager"]["first_name"]." ".$item["Manager"]["last_name"]; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>
