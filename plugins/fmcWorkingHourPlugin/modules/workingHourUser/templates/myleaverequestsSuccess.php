<?php slot ('title', "My leave requests"); ?>

<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>


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
            <th>Type</th>
            <th>From Date</th>
            <th>To Date</th>
            <th>Description</th>
            <th>Last Status</th>
            <th>Last Update</th>
        </tr>

        <?php foreach ($myLeaveRequests as $request): ?>
            <tr>
                <td>
                    <?php /*
                    <a href="<?php echo url_for('@workingHourUser_day?date='.$request['date']); ?>">
                        <?php echo $leaveStatus[$request["type"]]; ?>
                    </a>
                    */ ?>
                </td>
                <td><?php echo $request["from_Date"]; ?></td>
                <td><?php echo $request["to_Date"]; ?></td>
                <td><?php echo $request["description"]; ?></td>
                <td><?php echo $request["status"]; ?></td>
                <td>
                    <?php echo $request["updated_at"]; ?>
                </td>
            </tr>
        <?php endforeach; ?>

    </table>

<?php endif; ?>
