<?php
    $dayIOrecords = $day->getActiveIORecords();
    $dayWorkRecords = $day->getActiveWorkRecords();
    $ioCounter = 0;
    $wCounter = 0;
    $done = 0;
    $loopProtect = 0;
?>


<?php if (!(count($dayIOrecords)+count($dayWorkRecords))): ?>
    <p>No records so far.</p>
<?php else: ?>


<table class="table table-bordered table-hover table-condensed pull-left">
    
    <thead>
        <tr>
            <th>Project</th>
            <th>Type of Work</th>
            <th>From</th>
            <th>To</th>
            <th>Comment</th>
            <th>Action</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php while (($done < 3) && $loopProtect<100 ): ?>
            
            <?php
                $a = ($ioCounter >= count($dayIOrecords)) ? 1 : 0;
                $b = ($wCounter >= count($dayWorkRecords)) ? 2 : 0;
                $done = $a + $b;
            ?>
            
            <?php if ($done==0): /* If both records exist */ ?>
            
                <?php if ($dayIOrecords[$ioCounter]['time'] <= $dayWorkRecords[$wCounter]['start']): ?>
                    
                    <?php include_partial ('itemrow_io', array(
                        'record'=>$dayIOrecords[$ioCounter], 
                        'date'=>$day['date'], 
                    ) ); ?>
                    
                    <?php $ioCounter++; ?>
                    
                <?php else: ?>
                    
                    <?php include_partial ('itemrow_work', array(
                        'record'=>$dayWorkRecords[$wCounter], 
                        'date'=>$day['date'], 
                    ) ); ?>
                    
                    <?php $wCounter++; ?>
                    
                <?php endif; ?>
            
            <?php elseif ($done==1): /* If only work item exist */ ?>
                
                <?php include_partial ('itemrow_work', array(
                    'record'=>$dayWorkRecords[$wCounter], 
                    'date'=>$day['date'], 
                ) ); ?>
                
                <?php $wCounter++; ?>
                
            <?php elseif ($done==2): /* If only IO item exist */ ?>
                
                <?php include_partial ('itemrow_io', array(
                    'record'=>$dayIOrecords[$ioCounter], 
                    'date'=>$day['date'], 
                ) ); ?>
                
                <?php $ioCounter++; ?>
                
            <?php endif; ?>
            
            <?php
                $a = ($ioCounter >= count($dayIOrecords)) ? 1 : 0;
                $b = ($wCounter >= count($dayWorkRecords)) ? 2 : 0;
                $done = $a + $b;
                
                $loopProtect++;
            ?>
            
        <?php endwhile;?>
        
    </tbody>

</table>


<?php endif; ?>
