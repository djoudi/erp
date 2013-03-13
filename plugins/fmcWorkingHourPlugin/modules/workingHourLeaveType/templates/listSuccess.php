<?php slot ('title', "Leave Type List") ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<a class="pull-right btn btn-primary" href="<?php echo url_for('@workingHourLeaveType_new'); ?>">New Leave Type</a>

<?php if (!count($items)): ?>

    <p>No records found.</p>

<?php else: ?>

    <table class="pull-left tablesorter table table-hover table-condensed table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Has report</th>
                <th>Will be paid</th>
                <th>Yearly limit</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <a href="<?php echo url_for('workingHourLeaveType_edit',array('id'=>$item['id'])); ?>">
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
                    <td>
                        <?php if ($item['will_be_paid']): ?>
                            <i class="icon-ok"></i>
                        <?php else: ?>
                            <i class="icon-remove"></i>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($item["yearly_Limit"]): ?>
                            <?php echo $item["yearly_Limit"]; ?> days
                        <?php else: ?>
                            N/A
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

<div class="clearfix"></div>
