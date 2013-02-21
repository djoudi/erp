<?php slot ('title', "Add Custom Working Hours") ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<?php if (isset($filter)): ?>
    <?php include_partial ('fmcCore/filterForm', array(
        'filter'=>$filter, 
        'filtered'=>$filtered, 
        'count'=>count($items),
        'limit'=>$resultLimit
    )); ?>
<?php endif; ?>


<a class="btn btn-primary pull-right" href="<?php echo url_for('workingHoursManagement_addhours_new'); ?>">
    Add New
</a>

<?php if (!count($items)): ?>

    <p>No records found.</p>
    
<?php else: ?>

    <table class="tablesorter table table-hover table-bordered table-condensed">
        <thead>
            <tr>
                <th>Date</th>
                <th>Employee</th>
                <th>Minutes</th>
                <th>Comment</th>
                <th>Added By</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <?php echo $item["date"]; ?>
                    </td>
                    <td>
                        <?php echo $item->getEmployee(); ?>
                    </td>
                    <td>
                        <?php echo $item["minutes"]; ?>
                    </td>
                    <td>
                        <?php echo $item["comment"]; ?>
                    </td>
                    <td>
                        <?php echo $item->getAdder(); ?>
                    </td>
                    <td>
                        <a href="<?php echo url_for('workingHoursManagement_addhours_edit',array('id'=>$item["id"])); ?>">
                            <i class="icon-pencil"></i>
                        </a> 
                        
                        <?php include_partial ('fmcCore/confirmButton', array(
                            'url' => url_for('workingHoursManagement_addhours_delete',array('id'=>$item['id'])),
                            'iconOnly'=>true,
                            'iconClass'=>'icon-trash'
                        )); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
<?php endif; ?>
