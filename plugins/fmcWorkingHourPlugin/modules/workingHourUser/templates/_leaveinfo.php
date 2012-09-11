<table class="table table-bordered table-condensed">
    <tr>
        <th>
            Leave Date From
        </th>
        <td>
            <?php echo $leaveRequest['from_Date']; ?>
        </td>
    </tr>
    <tr>
        <th>
            Leave Date To
        </th>
        <td>
            <?php echo $leaveRequest['to_Date']; ?>
        </td>
    </tr>
    <tr>
        <th>
            Type
        </th>
        <td>
            <?php echo $leaveStatus[$leaveRequest->getType()]; ?>
        </td>
    </tr>
    <tr>
        <th>
            Description / Report Number
        </th>
        <td>
            <?php echo $leaveRequest['description']; ?>
        </td>
    </tr>
    <tr>
        <th>
            Current Status
        </th>
        <td>
            <?php echo $leaveRequest['status']; ?>
        </td>
    </tr>
</table>
