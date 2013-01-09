<?php slot ('title', "Employee List") ?>


<?php slot ('activeClass', "#topmenu_settings"); ?>


<p>
    <a class="btn btn-primary" href="<?php echo url_for('employeeManagement_new'); ?>">
        New Employee
    </a>
</p>


<p>
    <strong>Quick find : </strong>

    <?php include_partial ('fmcCore/typeahead', array(
        'items' => $items,
        'url' => '@employeeManagement_edit?id=',
        'class' => "employeeTypeahead",
        'col1' => "first_name",
        'seperator' => " ",
        'col2' => "last_name",
    )); ?>
    
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
