<?php slot ('title', "Departments List") ?>

<?php slot ('activeClass', "#topmenu_settings"); ?>

<a class="btn btn-primary pull-right" href="<?php echo url_for('departmentManagement_new'); ?>">
    New Department
</a>

<?php if (!count($items)): ?>

    <p>No records found.</p>

<?php else: ?>

    <table class="tablesorter table table-hover table-bordered table-condensed">
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
