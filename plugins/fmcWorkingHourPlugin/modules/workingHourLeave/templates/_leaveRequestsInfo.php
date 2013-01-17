<?php if (!count($leaveRequests)): ?>

    <p>No requests found.</p>

<?php else: ?>

    <table class="tablesorter3a table table-bordered table-condensed table-hover">
        <thead>
            <th>Status</th>
            <th>Type</th>
            <th>From</th>
            <th>To</th>
            <th>Comment</th>
            <th>Report Date</th>
            <th>Report Number</th>
            <th></th>
        </thead>
        
        <tbody>
            <?php foreach ($leaveRequests as $request): ?>
                <tr>
                    <td>
                        <?php echo $request['status']; ?>
                    </td>
                    <td>
                        <?php $url = url_for ('@workingHourLeave_info?leave_id='.$request['id'],true); ?>
                        <a href="<?php echo $url; ?>">
                            <?php echo $request->getLeaveType(); ?>
                        </a>
                    </td>
                    <td>
                        <?php echo $request['start_Date']; ?>
                    </td>
                    <td>
                        <?php echo $request['end_Date']; ?>
                    </td>
                    <td>
                        <?php echo $request['comment']; ?>
                    </td>
                    
                    <?php if ($request['LeaveType']['has_Report']): ?>
                    
                        <td>
                            <?php echo $request['report_Date']; ?>
                        </td>
                        <td>
                            <?php echo $request['report_Number']; ?>
                        </td>
                        
                    <?php else: ?>
                        
                        <td colspan="2"></td>
                        
                    <?php endif; ?>
                    
                    <td>
                        <?php $url = url_for ('@workingHourLeave_info?leave_id='.$request['id'],true); ?>
                        <a href="<?php echo $url; ?>">
                            View
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>

<?php endif; ?>
