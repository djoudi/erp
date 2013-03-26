<?php if (! $count = count($items) ): ?>

    <p>No records found.</p>

<?php else: ?>

    <p><strong></strong><?php echo $count; ?></strong> record(s) found.</p>

    <table class="tablesorter2a table table-hover table-condensed table-bordered">
        <thead>
            <tr>
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
