<?php include_partial ('title', array('date'=>$date, 'text'=>'New day entrance')); ?>

<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>


<div id="tabs">
    
	<ul>
		<li><a href="#workday">Work Day</a></li>
		<li><a href="#leaveday">Leave</a></li>
	</ul>
    
	<div id="workday">
        
        <p>To start a work day, please enter your office entrance hour.</p>
        
        <form action="" method="post">
  
            <?php echo $form->renderHiddenFields(); ?>

            <table class="table table-striped table-bordered table-condensed">
                <tr>
                    <th><?php echo $form['time']->renderLabel(); ?></th>
                    <td><?php echo $form['time']; ?></td>
                </tr>  
            </table>

            <div class="form-actions">
                <a class="btn" href="javascript:history.back(1)" >Cancel</a>
                <input type="submit" class="btn btn-success" value="Save and Continue"></input>
            </div>

        </form>
        
	</div>
    
	<div id="leaveday">
        
        <p>To create a leave request, please select leave type below.</p>
        
        <?php foreach ($leaveStatus as $type=>$text): ?>
            <?php
                $getLimit = "get".$type."Limit";
                $userLimit = $user->$getLimit();
            ?>
            <p>
                <a class="btn <?php if ( $userLimit <= $leaveUsageCount[$type] ): ?> disabled <?php endif; ?> "
                <?php if ( $userLimit>$leaveUsageCount[$type] ): ?>
                    href="<?php echo url_for('workingHourUser_leaverequest', array('date'=>$date, 'type'=>$type)); ?>"
                <?php endif; ?>>
                    <?php echo $text; ?>
                </a> 
                 ( <?php echo $leaveUsageCount[$type]; ?> of <?php echo $userLimit; ?> used)
            </p>
        <?php endforeach; ?>  
                
	</div>
    
</div>
