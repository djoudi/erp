<?php slot('title', 'Edit Work Day' ); ?>




<?php include_partial ('itemlist', array(
    'day'=>$day
)); ?>


<div class="clearfix"></div>


<ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">New Work Record</a></li>
    <li class=""><a href="#tab2" data-toggle="tab">Office Entrance</a></li>
    <li class=""><a href="#tab3" data-toggle="tab">Office Exit</a></li>
</ul>


<div class="tab-content">
    
    <div class="tab-pane active in" id="tab1">
        
        <?php $actionUrl=url_for('whuser_day_processform',array('date'=>$day['date'],'form_id'=>1)); ?>
        
        <form class="form-horizontal" method="post" action="<?php echo $actionUrl; ?>">
            <table class="table table-condensed table-bordered table-hover">
                <?php echo $workForm; ?>
            </table>
            <div class="form-actions">
                <input type="submit" class="btn btn-primary" value="Add" />
                <a class="btn" href="<?php echo url_for('wh_my_day',array('date'=>$day['date'])); ?>">
                    Revert Changes
                </a>
            </div>
        </form>
        
    </div>
    
    <div class="tab-pane" id="tab2">
        
        <?php $actionUrl=url_for('whuser_day_processform',array('date'=>$day['date'],'form_id'=>2)); ?>
        
        <form class="form-horizontal" method="post" action="<?php echo $actionUrl; ?>">
            <table class="table table-condensed table-bordered table-hover">
                <?php echo $entranceForm; ?>
            </table>
            <div class="form-actions">
                <input type="submit" class="btn btn-primary" value="Add" />
                <a class="btn" href="<?php echo url_for('wh_my_day',array('date'=>$day['date'])); ?>">
                    Revert Changes
                </a>
            </div>
        </form>

    </div>
    
    <div class="tab-pane" id="tab3">
        
        <?php $actionUrl=url_for('whuser_day_processform',array('date'=>$day['date'],'form_id'=>3)); ?>
        
        <form class="form-horizontal" method="post" action="<?php echo $actionUrl; ?>">
            <table class="table table-condensed table-bordered table-hover">
                <?php echo $exitForm; ?>
            </table>
            <div class="form-actions">
                <input type="submit" class="btn btn-primary" value="Add" />
                <a class="btn" href="<?php echo url_for('wh_my_day',array('date'=>$day['date'])); ?>">
                    Revert Changes
                </a>
            </div>
        </form>

    </div>
        
</div>
