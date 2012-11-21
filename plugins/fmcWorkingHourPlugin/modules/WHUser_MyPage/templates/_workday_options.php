<h4>Day actions</h4>

<table class="table table-bordered table-condensed table-hover">
    
    <tr>
        <th>Office Entrance</th>
        <td><?php echo $day['office_Entrance']; ?></td>
    </tr>
    
    <tr>
        <th>Office Exit</th>
        <td><?php echo $day['office_Exit']; ?></td>
    </tr>
    
</table>

<?php include_partial ('fmcCore/deleteConfirm', array(
    'class' => 'btn btn-danger btn-small',
    'url' => url_for('wh_my_day_deleteday',array('date'=>$day['date'])),
    'label' => 'Cancel Day'
)); ?>

<hr />
