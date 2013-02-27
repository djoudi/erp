<?php slot ('title', "Manage Leave Requests") ?>

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
                <th>Type</th>
                <th>Start</th>
                <th>End</th>
                <th>Comment</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <?php echo $item->getEmployee(); ?>
                    </td>
                    <td>
                        <?php echo $item->getLeaveType(); ?>
                    </td>
                    <td>
                        <?php echo $item['start_Date']; ?>
                    </td>
                    <td>
                        <?php echo $item['end_Date']; ?>
                    </td>
                    <td>
                        <?php echo $item['comment']; ?>
                    </td>
                    <td>
                        <?php echo $item['status']; ?>
                    </td>
                    <td>
                        <?php if ($item["status"]=="Draft"): ?>
                            
                        <?php else: ?>
                            <a href="<?php echo url_for("workingHoursLeaveManagement_makedraft",array("id"=>$item["id"])); ?>">
                                Change to Draft
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>
