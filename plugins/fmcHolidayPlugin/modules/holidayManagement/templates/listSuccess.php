<?php slot ('title', "Holiday List") ?>

<?php slot ('activeClass', "#topmenu_settings"); ?>

<a class="pull-right btn btn-primary" href="<?php echo url_for('@holidayManagement_new'); ?>">New Holiday</a>

<?php if (!count($items)): ?>

    <p>No records found.</p>

<?php else: ?>

    <table class="pull-left tablesorter table table-hover table-condensed table-bordered">
        <thead>
            <tr>
                <th>Day</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <?php echo $item['day']; ?>
                    </td>
                    <td>
                        <a href="<?php echo url_for('holidayManagement_edit',array('id'=>$item['id'])); ?>">
                            <?php echo $item['name']; ?>
                        </a>
                    </td>                
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

<div class="clearfix"></div>
