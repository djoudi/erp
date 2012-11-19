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
        </tr>
    </thead>
    
    <tbody>
        
        <?php include_partial ('ioline', array('record'=>$dayIOrecords[0]) ); ?>
        
        <?php /*$j=1; foreach ($dayWorkRecords as $work): ?>
            
            <?php while ( ($dayIOrecords[$j]["time"] < $work["start"] ) && (count($dayIOrecords)>($j)) ): ?>
                <?php include_partial ('ioline', array('record'=>$dayIOrecords[$j]) ); ?>
                <?php $j++; ?>
            <?php endwhile; ?>
            
        <tr>
            <td><?php echo $work->getProject(); ?></td>
            <td><?php echo $work->getWorkType(); ?></td>
            <td><?php echo $work->getStart(); ?></td>
            <td><?php echo $work->getEnd(); ?></td>
            <td><?php echo $work->getComment(); ?></td>
        </tr>
            
        <?php endforeach; ?>
  
        <?php while ( count($dayIOrecords)>$j ): ?>
            <?php include_partial ('ioline', array('record'=>$dayIOrecords[$j]) ); ?>
            <?php $j++; ?>
        <?php endwhile; */?>
        
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
