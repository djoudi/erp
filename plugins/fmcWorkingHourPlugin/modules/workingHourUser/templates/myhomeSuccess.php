<?php slot ('title', 'My working hours'); ?>


<div class="pull-left">

    <h4>Today</h4>
    
    <?php if ($dayType == "empty"): ?>
        
        <p>You haven't entered today yet.</p>
    
    <?php elseif ($dayType == "leave"): ?>
    
        <p>You have a leave request for today.</p>
        
        <?php include_partial ('leaveinfo', array('leaveRequest'=>$leaveRequest, 'leaveStatus'=>$leaveStatus)); ?>
        
    <?php else: ?>
        
        <p>
            <strong>Office entrance:</strong> <?php echo $entranceHour["time"]; ?><br />
            <strong>Office exit:</strong> <?php echo $exitHour["time"]; ?>
        </p>
        
        <?php if (count($items)): ?>
            <table class="table table-condensed table-bordered">      
                <thead>
                    <tr>
                        <th>Project</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Total</th>
                        <th>Type of Work</th>
                        <th>Comments</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include_partial ("dayitems_list", array("items"=>$items, "edit"=>false)); ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No items found.</p>
        <?php endif; ?>
        
    <?php endif; ?>
    
    <p>
        <a href="<?php echo $todayUrl;?>">Click here to go to today.</a>
    </p>
    
</div>  


<div class="pull-right">
  
  <h4>Calendar</h4>
  <?php include_partial ('dateselector'); ?>
  
</div>


<div class="clear"></div>

