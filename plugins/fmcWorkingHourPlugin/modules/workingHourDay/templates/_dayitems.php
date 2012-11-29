<?php if (!count($day->getWorkingHourRecords())): ?>

    <p><strong>No records found.</strong></p>
    
<?php else: ?>

<table class="table table-bordered table-hover table-condensed pull-left">
    
    <thead>
        <tr>
            <th>Type</th>
            <th>From</th>
            <th>To</th>
            <th>Project</th>
            <th>Type of Work</th>
            <th>Comment</th>
            
            <?php if ($day['status']=="Draft"): ?>
                <th>Action</th>
            <?php endif; ?>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach ($day->getWorkingHourRecords() as $record): ?>
        
            <?php $class = ($sf_user->getFlash('errorRow')==$record['id']) ? "error" : ""; ?>
            
            <tr class="<?php echo $class; ?>">
                <td><?php echo $record['recordType']; ?></td>
                <td><?php echo $record['start_Time']; ?></td>
                <td><?php echo $record['end_Time']; ?></td>
                <td><?php echo $record->getProject(); ?></td>
                <td><?php echo $record->getWorkType(); ?></td>
                <td><?php echo $record['comment']; ?></td>
                
                <td>
                    <?php if ($day['status']=="Draft"): ?>
                        <?php include_partial ('fmcCore/confirmButton', array(
                            'url' => url_for('workingHourDay_deleteitem',array(
                                'date'=>$day['date'],
                                'id'=>$record['id']
                            )),
                            'label' => 'Delete',
                        )); ?>
                    <?php endif; ?>
                </td>
                
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

<?php endif; ?>
