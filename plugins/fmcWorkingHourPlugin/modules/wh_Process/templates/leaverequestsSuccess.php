<?php slot ('title', "Process leave requests"); ?>


<?php if (isset($filter)): ?>
  <?php include_partial ('fmcCore/filterForm', array(
  'filter'=>$filter, 
  'filtered'=>$filtered, 
  'count'=>count($myLeaveRequests)
  )); ?>
<?php endif; ?>


<?php if ($resultslimited): ?>
  <div class="alert">
    <a class="close" data-dismiss="alert" href="#">×</a>
    More than <strong><?php echo count($myLeaveRequests); ?></strong> results found, 
    showing first <strong><?php echo count($myLeaveRequests); ?></strong> results. Please filter your result.
  </div>
<?php endif; ?>


<?php if (!count($myLeaveRequests)): ?>

    <p>No leave requests found in your selected criterias.</p>
    
<?php else: ?>

    <table class="table table-bordered table-condensed">

        <tr>
            <th>User</th>
            <th>Type</th>
            <th>Date</th>
            <th>Description</th>
            <th>Last Status</th>
            <th>Last Update</th>
        </tr>

        <?php foreach ($myLeaveRequests as $request): ?>
            <tr>
                <td>
                    <?php echo $request["User"]["first_name"]." ".$request["User"]["last_name"]; ?>
                </td>
                
                <td>
                    <a href="<?php echo url_for('@wh_process_leaverequests_process?id='.$request['id']); ?>">
                        <?php echo $leaveStatus[$request["type"]]; ?>
                    </a>
                </td>
                <td><?php echo $request["date"]; ?></td>
                <td><?php echo $request["description"]; ?></td>
                <td><?php echo $request["status"]; ?></td>
                <td>
                    <?php echo $request["updated_at"]; ?>
                    by <?php echo $request["StatusUser"]["first_name"]." ".$request["StatusUser"]["last_name"]; ?>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

<?php endif; ?>
