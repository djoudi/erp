<?php
    slot ('title', "My Working Hour Reports");
    slot ('activeClass', "#topmenu_workinghours");
?>

<table class="table table-bordered table-condensed table-hover">
    <thead>
        <tr>
            <th>Date</th>
            <th>Day hours</th>
            <th>Type</th>
            <th>Status</th>
            <th>Worked</th>
            <th>Breaks</th>
            <th>Day balance</th>
            <th>Total balance</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th colspan="7">
                Until <?php echo $results[0]["date"]; ?>
            </th>
            <th>
                <?php echo $upToDayBalanceHuman; ?>
            </th>
        </tr>
        <tr>
            <?php foreach ($results as $day): ?>
                <tr class='<?php echo $day["dayClass"]; ?>'>
                    <td>
                        <?php echo $day["date"]; ?>, <?php echo $day["dayOfTheWeek"]; ?>
                    </td>
                    <td>
                        <?php echo $day["dayHoursHuman"]; ?>
                    </td>
                    <td>
                        <?php echo $day["dayType"]=="Empty" ? "-" : $day["dayType"]; ?>
                    </td>
                    <td>
                        <?php echo $day["dayStatus"]; ?>
                    </td>
                    <td>
                        <?php echo $day["workedHoursHuman"]; ?>
                        <?php if ($day["dayMultiplier"] > 1) echo " (x".round($day['dayMultiplier'],2).")"; ?>
                    </td>
                    <td>
                        <?php echo $day["dayBreaksHuman"]; ?>
                    </td>
                    <td>
                        <?php echo $day["dayBalanceHuman"]; ?>
                    </td>
                    <td>
                        <?php echo $day["totalBalanceHuman"]; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tr>
    </tbody>
</table>
