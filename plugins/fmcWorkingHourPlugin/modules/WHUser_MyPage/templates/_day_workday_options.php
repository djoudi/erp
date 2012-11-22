<hr />

<h4>Day actions</h4>

<table class="table table-bordered table-condensed table-hover">
    <tr>
        <th>Day Status</th>
        <td><?php echo $day['status']; ?></td>
    </tr>
    <tr>
        <th>Office Entrance</th>
        <td><?php echo $day['office_Entrance']; ?></td>
    </tr>
    <tr>
        <th>Office Exit</th>
        <td><?php echo $day['office_Exit']; ?></td>
    </tr>
</table>


<?php if ($day['status']=="Draft"): ?>

    <ul class="unstyled">
        <p>
            <?php include_partial ('fmcCore/confirmButton', array(
                'class' => 'btn btn-success btn-small',
                'url' => url_for('wh_my_day_sendapprove',array('date'=>$day['date'])),
                'label' => 'Send for Approve',
                'text' => 'Are you sure you want to send this day for approval?',
                "iconClass" => 'icon-ok icon-white'
            )); ?>

        </p>
        <p>
            <?php include_partial ('fmcCore/confirmButton', array(
                'class' => 'btn btn-danger btn-small',
                'url' => url_for('wh_my_day_deleteday',array('date'=>$day['date'])),
                'label' => 'Cancel Day',
                "iconClass" => 'icon-remove icon-white'
            )); ?>
        </p>
    </ul>

<?php endif; ?>

<hr />
