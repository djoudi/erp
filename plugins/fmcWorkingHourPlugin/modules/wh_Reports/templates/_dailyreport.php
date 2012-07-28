<hr />

<h4>
    Showing daily report for date 
    <?php include_partial ('wh_Core/dateinfo', array('date'=>$date)); ?>:
</h4>

<table class="table table-condensed table-bordered">
    
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Department</th>
            <th>Entrance</th>
            <th>Exit</th>
        </tr>
    </thead>
    
    <tbody>
    
        <?php $i=1; ?>
        
        <?php foreach ($users as $user): ?>
            <?php $status = $user->getDayStatusFor($date); ?>
            <tr>
                <td>
                    <?php echo $i; ?>
                </td>
                <td>
                    <?php echo $user["first_name"]." ".$user["last_name"];#->__toString(); ?>
                </td>
                <td>
                    <?php echo $user["Department"]["name"]; ?>
                </td>
                
                <?php if ($status=="leave"): ?>
                
                    <td colspan="2">
                        leave
                    </td>
                    
                <?php elseif ($status=="work"): ?>
                
                    <td>
                        <?php echo $user->getEntranceFor ($date); ?>
                    </td>
                    <td>
                        <?php echo $user->getExitFor ($date); ?>
                    </td>
                    
                <?php elseif ($status=="empty"): ?>
                
                    <td colspan="2">-</td>
               
                <?php endif; ?>
            </tr>
            
            <?php $i++; ?>
            
        <?php endforeach; ?>
    
    </tbody>
    
</table>
