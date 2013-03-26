<?php if (!isset($is_inactive)) $is_inactive = true; ?>

<?php if (! $count = count($items) ): ?>

    <p>No records found.</p>

<?php else: ?>

    <p><strong><?php echo $count; ?></strong> record(s) found.</p>

    <table class="tablesorter1a table table-hover table-condensed table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Username</th>
                <?php if (!$is_inactive): ?>
                    <th>E-mail</th>
                <?php endif; ?>
                <th>Title</th>
                <th>Department</th>
                <th>Last Login</th>
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
                        <?php echo $employee["username"]; ?>
                    </td>
                    <?php if (!$is_inactive): ?>
                        <td>
                            <span style="color: #fff !important;">
                                <?php echo $employee["send_Email"]; ?>
                            </span>
                            <?php if ($employee["send_Email"]): ?>
                                <i class="icon-ok"></i>
                            <?php endif; ?>
                        </td>
                    <?php endif; ?>
                    <td>
                        <?php echo $employee["title"]; ?>
                    </td>
                    <td>
                        <?php echo $employee["Department"]["name"]; ?>
                    </td>
                    <td>
                        <?php echo $employee["last_login"]; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>
