<?php slot ('title', "Employee List") ?>

<p>
    <a class="btn btn-primary" href="<?php echo url_for('employeeManagement_new'); ?>">New employee</a>
</p>

<?php if (isset($filter)): ?>
    <?php include_partial ('fmcCore/filterForm', array(
        'filter'=>$filter, 
        'filtered'=>$filtered, 
        'count'=>count($items)
    )); ?>
<?php endif; ?>

<table class="tablesorter2a tablesorterpager table table-striped table-bordered table-condensed">
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
                        <img src="/images/tick.png" />
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
