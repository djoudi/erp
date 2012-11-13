<?php slot ('title', "Leave Type List") ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<a class="pull-right btn btn-success" href="<?php echo url_for('@whparam_leavetype_new'); ?>">New Leave Type</a>

<?php if (!count($items)): ?>

    <p>No records found.</p>

<?php else: ?>

    <table class="pull-left tablesorter table table-hover table-condensed table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Has Report</th>
                <th>Default Limit</th>
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
                    <td>
                        <?php echo $item['default_Limit']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

<div class="clearfix"></div>
