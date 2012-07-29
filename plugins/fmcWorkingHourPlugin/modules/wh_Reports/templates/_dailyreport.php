<hr />

<h4>
    Showing daily report for date 
    <?php include_partial ('wh_Core/dateinfo', array('date'=>$date)); ?>:
</h4>

<table class="table table-condensed table-bordered">
    
    <thead>
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Department</th>
            <th>Entrance</th>
            <th>Exit</th>
            <th>Office Hours</th>
            <th>Worked Hours</th>
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
                    <?php echo $user["first_name"]." ".$user["last_name"]; ?>
                </td>
                <td>
                    <?php echo $user["Department"]["name"]; ?>
                </td>
                
                <?php if ($status=="leave"): ?>
                    
                    <?php $leave = $user->getLeave($date); ?>
                    
                    <td colspan="4">
                        <?php echo $leaveStatus[$leave["type"]]; ?>
                        <?php if ($leave["description"]): ?>
                            - <?php echo $leave["description"]; ?>
                        <?php endif; ?>
                    </td>
                    
                <?php elseif ($status=="work"): ?>
                
                    <td>
                        <?php echo $user->getEntranceFor($date); ?>
                    </td>
                    <td>
                        <?php echo $user->getExitFor($date); ?>
                    </td>
                    <td>
                        <?php echo $user->getOfficeDif($date); ?>
                    </td>
                    <td>
                        <?php echo $user->getActiveHours($date); ?>
                    </td>
                    
                <?php elseif ($status=="empty"): ?>
                
                    <td colspan="4">-</td>
               
                <?php endif; ?>
            </tr>
            
            <?php $i++; ?>
            
        <?php endforeach; ?>
    
    </tbody>
    
</table>


<div class="form-actions">
    <a 
        class="btn btn-info" 
        href="<?php echo url_for('@wh_reports_officeentrance_excel?date='.$date) ?>"
    >Download Report</a>
</div>
