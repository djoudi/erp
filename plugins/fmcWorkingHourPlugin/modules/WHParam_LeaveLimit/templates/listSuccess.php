<?php slot ('title', "Leave Limits List") ?>

<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>

<?php if (!count($employees)): ?>

    <p>No users found.</p>

<?php else: ?>

    <table class="table table-bordered table-condensed table-hover">
        <thead>
            <tr>
                <th>Employee</th>
                <?php foreach ($leavetypes as $type): ?>
                    <th>
                        <?php echo $type['name']; ?>
                    </th>
                <?php endforeach; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employees as $employee): ?>
                <tr>
                    <td>
                        <?php echo $employee['first_name']." ".$employee['last_name']; ?>
                    </td>
                    <td></td>
                    <td></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>




<?php endif; ?>


<?php /*

<p>To set leave limits per employee, please click the employee's name you want to set leave limits of:</p>

<?php if (!count($items)): ?>

    <p>No users found.</p>

<?php else: ?>
    
    <table class="table table-striped table-bordered table-condensed">
        <tr>
            
            <?php $col = 6; ?>
            
            <?php for ($i=0; $i<count($items); $i++): ?>
                <td>
                    <a href="<?php echo $edit_url.$items[$i]['id']; ?>">
                        <?php echo $items[$i]["name"]; ?>
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











<?php slot ('title', "Leave Type List") ?>

<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>

<a class="pull-right btn btn-success" href="<?php echo url_for('@whparam_leavetype_new'); ?>">New Leave Type</a>

<?php if (!count($items)): ?>

    <p>No records found.</p>

<?php else: ?>

    <table class="pull-left tablesorter table table-hover table-condensed table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Has Report</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <a href="<?php echo url_for('@whparam_leavetype_edit?id='.$item['id']); ?>">
                            <?php echo $item['name']; ?>
                        </a>
                    </td>                
                    <td>
                        <?php if ($item['has_Report']): ?>
                            <i class="icon-ok"></i>
                        <?php else: ?>
                            <i class="icon-remove"></i>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

<div class="clearfix"></div>


*/ ?>
