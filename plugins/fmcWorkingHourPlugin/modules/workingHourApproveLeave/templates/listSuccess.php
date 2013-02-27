<?php slot ('title', "Approve Leave Requests") ?>


<?php slot ('activeClass', "#topmenu_workinghours"); ?>


<?php if (isset($filter)): ?>
    <?php include_partial ('fmcCore/filterForm', array(
        'filter'=>$filter, 
        'filtered'=>$filtered, 
        'count'=>count($items),
        'limit'=>$resultLimit
    )); ?>
<?php endif; ?>



<?php if (count($items)): ?>


<h4>List of Pending Leave Requests</h4>


    <table class="table table-hover table-bordered table-condensed">
        <thead>
            <tr>
                <th>Employee</th>
                <th>Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th># of Days</th>
                <th>Report Date</th>
                <th>Report Number</th>
                <th>Report Receive Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <?php echo $item['Employee']['first_name']." ".$item['Employee']['last_name']; ?>
                    </td>
                    <td>
                        <a href="<?php echo url_for('workingHourApproveLeave_details',array('id'=>$item['id'])); ?>">
                            <?php echo $item['LeaveType']['name']; ?>
                        </a>
                    </td>
                    <td>
                        <?php echo $item['start_Date']; ?>
                    </td>
                    <td>
                        <?php echo $item['end_Date']; ?>
                    </td>
                    <td>
                        <?php echo $item['day_Count']; ?>
                    </td>
                    <td>
                        <?php echo $item['report_Date']; ?>
                    </td>
                    <td>
                        <?php echo $item['report_Number']; ?>
                    </td>
                    <td>
                        <?php if ($item['report_Received']): ?>
                            <?php echo $item['report_Received']; ?>
                        <?php else: ?>
                            Not received
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo url_for('workingHourApproveLeave_details',array('id'=>$item['id'])); ?>">
                            Show
                        </a>
                    </td>
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>


<?php endif; ?>
