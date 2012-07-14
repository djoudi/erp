<?php slot ('title', "My leave requests"); ?>

<table class="table table-bordered table-condensed">

    <tr>
        <th>Type</th>
        <th>Date</th>
        <th>Description</th>
        <th>Last Status</th>
        <th>Last Update</th>
    </tr>

    <?php foreach ($myLeaveRequests as $request): ?>
        <tr>
            <td>
                <?php if ($request["status"]=="Pending" or $request["status"]=="Approved"): ?>
                    <a href="<?php echo url_for('@workingHourUser_day?date='.$request['date']); ?>"><?php echo $leaveStatus[$request["type"]]; ?></a>
                <?php else: ?>
                    <?php echo $leaveStatus[$request["type"]]; ?>
                <?php endif; ?>
                
                
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
