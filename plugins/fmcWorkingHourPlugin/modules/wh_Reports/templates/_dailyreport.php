<hr />

<h4>
    Showing daily report for date 
    <?php include_partial ('wh_Core/dateinfo', array('date'=>$date)); ?>:
</h4>

<table class="table table-condensed table-bordered">
    
    <tr>
        <th>Name</th>
        <th>Status</th>
        <th>Entrance</th>
        <th>Exit</th>
    </tr>
    
    <?php foreach ($users as $user): ?>
        <tr>
            <td>
                <?php echo $user->__toString(); ?>
            </td>
            <td>
                <?php $status = $user->getDayStatusFor($date); ?>
                
                <?php if ($status=="empty"): ?>
                    Hasn't entered yet.
                <?php elseif ($status=="leave"): ?>
                    On leave
                <?php else: ?>
                    Work day
                <?php endif; ?>
            </td>
            <td>
                <?php echo $user->getEntranceFor ($date); ?>
            </td>
            <td>
                <?php echo $user->getExitFor ($date); ?>
            </td>
        </tr>
    <?php endforeach; ?>
    
</table>
