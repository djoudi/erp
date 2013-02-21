<?php slot ('title', "Manage Working Hours") ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<?php if (isset($filter)): ?>
    <?php include_partial ('fmcCore/filterForm', array(
        'filter'=>$filter, 
        'filtered'=>$filtered, 
        'count'=>count($items),
        'limit'=>$resultLimit
    )); ?>
<?php endif; ?>

<?php if (!count($items)): ?>

    <p>No records found.</p>
    
<?php else: ?>

    <table class="tablesorter table table-hover table-bordered table-condensed">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Date</th>
                <th>Status</th>
                <th>Multiplier</th>
                <th>Daily Breaks</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <?php echo $item->getEmployee(); ?>
                    </td>
                    <td>
                        <?php echo $item["date"]; ?>
                    </td>
                    <td>
                        <?php echo $item["status"]; ?>
                    </td>
                    <td>
                        <?php echo $item["multiplier"]; ?>
                    </td>
                    <td>
                        <?php echo $item["daily_Breaks"]; ?>
                    </td>
                    <td>
                        Actions
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>
