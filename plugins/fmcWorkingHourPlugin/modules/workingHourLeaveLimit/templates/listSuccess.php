<?php slot ('title', "Leave Limits List"); ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<p>
    You can see the <strong>default limits for each leave types</strong> below. 
    Click on the name of the leave type to change its default settings.
</p>

<?php if (!count($leaveTypes)): ?>

    <p>No leave types found.</p>

<?php else: ?>
    
    <table class="table table-bordered table-condensed table-hover">
        <?php foreach ($leaveTypes as $type): ?>
            <tr>
                <td>
                    <a href="<?php echo url_for('workingHourLeaveType_edit',array('id'=>$type['id'])); ?>">
                        <?php echo $type['name']; ?>
                    </a>
                </th>
                <td class="w100">
                    <?php echo $type['default_Limit']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php endif; ?>

<p>
    To set leave limits <strong>per employee</strong>, please click the employee's name you want to set leave limits of:
</p>

<?php if (!count($employees)): ?>

    <p>No users found.</p>

<?php else: ?>
    
    <table class="table table-striped table-bordered table-condensed">
        <tr>
            
            <?php $col = 6; ?>
            
            <?php for ($i=0; $i<count($employees); $i++): ?>
                <td>
                    <a href="<?php echo url_for('workingHourLeaveLimit_edit',array('id'=>$employees[$i]['id'])); ?>">
                        <?php echo $employees[$i]["name"]; ?>
                    </a>
                </td>
                
                <?php if ($i>0 && (($i+1)%$col==0)): ?>
                    </tr><tr>
                <?php endif; ?>
                
            <?php endfor; ?>
            
            <?php if ($i>$col): ?>
            
                <?php while ($i++ % $col!=0): ?>
                    <td></td>
                <?php endwhile; ?>
            
            <?php endif; ?>
            
        </tr>
    </table>

<?php endif; ?>
