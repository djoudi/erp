<?php slot('title', 'Edit Work Day' ); ?>


<a class="btn btn-danger btn-small pull-right" onclick="
      if (confirm('If you continue, all records for today will be DELETED. Are you sure?'))
        parent.location='<?php echo url_for('@wh_user_day_deleteday?date='.$date); ?>'
">
    <i class="icon-remove icon-white"></i>
    Delete Day
</a>


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


<div class="clearfix"></div>


<ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">New Work Record</a></li>
    <li class=""><a href="#tab2" data-toggle="tab">Office Entrance</a></li>
    <li class=""><a href="#tab3" data-toggle="tab">Office Exit</a></li>
</ul>


<div class="tab-content">
    
    <div class="tab-pane fade active in" id="tab1">
        
        <?php $actionUrl=url_for('whuser_day_processform',array('date'=>$date,'form_id'=>1)); ?>
        
        <form class="form-horizontal" method="post" action="<?php echo $actionUrl; ?>">
            <table class="table table-condensed table-bordered table-hover">
                <?php echo $workForm; ?>
            </table>
            <div class="form-actions">
                <input type="submit" class="btn btn-primary" value="Add" />
            </div>
        </form>
        
    </div>
    
    <div class="tab-pane fade" id="tab2">
        
        <?php $actionUrl=url_for('whuser_day_processform',array('date'=>$date,'form_id'=>2)); ?>
        
        <form class="form-horizontal" method="post" action="<?php echo $actionUrl; ?>">
            <table class="table table-condensed table-bordered table-hover">
                <?php echo $entranceForm; ?>
            </table>
            <div class="form-actions">
                <input type="submit" class="btn btn-primary" value="Add" />
            </div>
        </form>

    </div>
    
    <div class="tab-pane fade" id="tab3">
        
        <?php $actionUrl=url_for('whuser_day_processform',array('date'=>$date,'form_id'=>3)); ?>
        
        <form class="form-horizontal" method="post" action="<?php echo $actionUrl; ?>">
            <table class="table table-condensed table-bordered table-hover">
                <?php echo $exitForm; ?>
            </table>
            <div class="form-actions">
                <input type="submit" class="btn btn-primary" value="Add" />
            </div>
        </form>

    </div>
    
</div>
