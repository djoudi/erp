<?php slot ('title', "Leave Limits List"); ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<p>Here you can see and add leave limits to employees.</p>

<table class="table table-striped table-bordered table-condensed">
    <tr>
        
        <?php $col = 6; ?>
        
        <?php for ($i=0; $i<count($employees); $i++): ?>
            <td>
                <a href="<?php echo url_for('workingHourLeaveLimit_details',array('id'=>$employees[$i]['id'])); ?>">
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
