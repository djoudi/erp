<table class="table table-bordered table-hover table-condensed pull-left">
    
    <thead>
        <tr>
            <th>Project</th>
            <th>Type of Work</th>
            <th>From</th>
            <th>To</th>
            <th>Comments</th>
            <th>Action</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php $ioCounter = 0; $wCounter = 0; $done = 0; $loopProtect=0;?>
        
        <?php while (($done < 3) && $loopProtect<100 ): ?>
            
            <?php if ($ioCounter >= count($dayIOrecords)) $a=1; else $a=0;?>
            <?php if ($wCounter >= count($dayWorkRecords)) $b=2; else $b=0; ?>
            <?php $done = $a+$b; ?>
            
            <?php if ($done==0): ?>
            
                <?php if ($dayIOrecords[$ioCounter]['time'] <= $dayWorkRecords[$wCounter]['start']): ?>
                    
                    <?php include_partial ('itemrow_io', array('record'=>$dayIOrecords[$ioCounter], 'date'=>$date) ); ?>
                    <?php $ioCounter++; ?>
                    
                <?php else: ?>
                    
                    <?php include_partial ('itemrow_work', array('record'=>$dayWorkRecords[$wCounter], 'date'=>$date) ); ?>
                    <?php $wCounter++; ?>
                    
                <?php endif; ?>
            
            <?php elseif ($done==1): ?>
                
                <?php include_partial ('itemrow_work', array('record'=>$dayWorkRecords[$wCounter], 'date'=>$date) ); ?>
                <?php $wCounter++; ?>
                
            <?php elseif ($done==2): ?>
                
                <?php include_partial ('itemrow_io', array('record'=>$dayIOrecords[$ioCounter], 'date'=>$date) ); ?>
                <?php $ioCounter++; ?>
                
            <?php endif; ?>
            
            
            <?php if ($ioCounter >= count($dayIOrecords)) $a=1; else $a=0;?>
            <?php if ($wCounter >= count($dayWorkRecords)) $b=2; else $b=0; ?>
            <?php $done = $a+$b; ?>
            
            <?php $loopProtect++; ?>
            
        <?php endwhile;?>
        
    </tbody>

</table>
