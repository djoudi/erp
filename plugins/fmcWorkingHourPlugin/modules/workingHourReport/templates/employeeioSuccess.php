<?php slot('title', 'Employee Entrance-Exit Report' ); ?>


<?php slot ('activeClass', "#topmenu_workinghours"); ?>


<table class="tablesorter table table-bordered table-condensed table-hover">
    <thead>
        <tr>
            <th>Name</th>
            <th>Entrance</th>
            <th>Exit</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($employees as $employee): ?>
            <tr>
                <td>
                    <?php echo $employee; ?>
                </td>
                <td>
                    <?php echo $employee['office_Entrance'] ? $employee['office_Entrance'] : "N/A"; ?>
                </td>
                <td>
                    <?php echo $employee['office_Exit'] ? $employee['office_Exit'] : "N/A"; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
