<?php slot ('title', "Leave Limits for {$employee}"); ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>


<a class="btn pull-right" href="<?php echo url_for("@workingHourLeaveLimit_list"); ?>">
    Show all employees
</a>


<ul class="nav nav-tabs">
    <li class="<?php if (!$sf_user->getFlash("error")): ?>active<?php endif; ?>">
        <a href="#tab1" data-toggle="tab">
            Summary
        </a>
    </li>
    <li class="<?php if ($sf_user->getFlash("error")): ?>active<?php endif; ?>">
        <a href="#tab2" data-toggle="tab">
            Add Limit
        </a>
    </li>
    <li class="">
        <a href="#tab3" data-toggle="tab">
            Previous Additions
        </a>
    </li>
</ul>


<div class="tab-content">
    
    <div class="tab-pane <?php if (!$sf_user->getFlash("error")): ?>active in<?php endif; ?>" id="tab1">
    
        <p>Current Limits for <strong><?php echo $employee; ?></strong>:</p>
        
        <table class="table table-bordered table-condensed table-hover">
            
            <?php foreach ($leaveTypes as $leaveType): ?>
                <tr>
                    <td>
                        <?php echo $leaveType; ?>
                    </td>
                    <td>
                        <?php echo $employee->getLeaveLimitSum($leaveType["id"]); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            
        </table>
        
    </div>
    
    <div class="tab-pane <?php if ($sf_user->getFlash("error")): ?>active in<?php endif; ?>" id="tab2">
    
        <p>Add limit to <strong><?php echo $employee; ?></strong>:</p>
        
        <form method="post">
            
            <table class="table table-bordered table-condensed table-hover">
                <?php echo $form; ?>
            </table>
            
            <div class="form-actions">
                <input type="submit" value="Add Limit" class="btn btn-success" />
            </div>
            
        </form>
        
    </div>
    
    <div class="tab-pane" id="tab3">
        
        <?php if (!($count = count($employee->getLeaveRequestEmployeeLimits()))): ?>
            
            <p>No records found.</p>
            
        <?php else: ?>
        
            <p><strong><?php echo $count; ?></strong> records found.</p>
            
            <table class="tablesorter table table-bordered table-condensed table-hover">
                
                <thead>
                    <th>Date</th>
                    <th>Leave type</th>
                    <th>Limit</th>
                    <th>Comment</th>
                    <th>Added by</th>
                    <th>Actions</th>
                </thead>
                
                <tbody>
                    
                    <?php foreach ($employee->getLeaveRequestEmployeeLimits() as $record): ?>
                        <tr>
                            <td>
                                <?php echo $record["created_at"]; ?>
                            </td>
                            <td>
                                <?php echo $record->getLeaveType(); ?>
                            </td>
                            <td>
                                <?php echo $record["leave_Limit"]; ?>
                            </td>
                            <td>
                                <?php echo $record["comment"]; ?>
                            </td>
                            <td>
                                <?php echo $record->getAdder(); ?>
                            </td>
                            <td>
                                <?php include_partial ('fmcCore/confirmButton', array(
                                    'url' => url_for('workingHourLeaveLimit_delete',array(
                                        'id'=>$record['id']
                                    )),
                                    'label' => 'Delete',
                                )); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                </tbody>
                
            </table>
            
        <?php endif; ?>
        
    </div>

</div>








