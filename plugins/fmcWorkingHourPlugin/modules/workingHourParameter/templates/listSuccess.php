<?php slot ('title', "Working Hour Parameters") ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<?php if (!count($items)): ?>

    <p>No records found.</p>

<?php else: ?>

    <table class="pull-left tablesorter table table-hover table-condensed table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <a href="<?php echo url_for('workingHourParameter_edit',array('id'=>$item['id'])); ?>">
                            <?php echo $item['description']; ?>
                        </a>
                    </td>
                    <td>
                        <?php if ($item["value_leavetype_id"]): ?>
                                <?php echo $item->getLeaveType(); ?>
                        <?php else: ?>
                            <?php echo $item['value']; ?>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

<div class="clearfix"></div>
