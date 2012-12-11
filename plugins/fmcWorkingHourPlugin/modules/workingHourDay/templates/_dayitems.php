<?php if (!count($dayRecords)): ?>

    <p><strong>No records found.</strong></p>
    
<?php else: ?>

<table class="table table-bordered table-hover table-condensed">
    
    <thead>
        <tr>
            <th>Type</th>
            <th>From</th>
            <th>To</th>
            <th>Project</th>
            <th>Type of Work</th>
            <th>Comment</th>
            
            <?php if ($dayStatus=="Draft"): ?>
                <th>Action</th>
            <?php endif; ?>
        </tr>
    </thead>
    
    <tbody>
        <?php foreach ($dayRecords as $record): ?>
        
            <?php $class = ($sf_user->getFlash('errorRow')==$record['id']) ? "error" : ""; ?>
            
            <tr class="<?php echo $class; ?>">
                <td>
                    <?php echo $record['recordType']; ?>
                </td>
                <td>
                    <?php echo $record['start_Time']; ?>
                </td>
                <td>
                    <?php echo $record['end_Time']; ?>
                </td>
                <td>
                    <?php if ($record['project_id']): ?>
                        <?php echo $record['Project']['code']; ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($record['work_Type_id']): ?>
                        <?php echo $record['WorkType']['name']; ?>
                    <?php endif; ?>
                </td>
                <td>
                    <?php echo $record['comment']; ?>
                </td>
                
                <?php if ($dayStatus=="Draft"): ?>
                    <td>
                        <?php include_partial ('fmcCore/confirmButton', array(
                            'url' => url_for('workingHourDay_deleteitem',array(
                                'date'=>$dayDate,
                                'id'=>$record['id']
                            )),
                            'label' => 'Delete',
                        )); ?>
                    </td>
                <?php endif; ?>
                
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>

<?php endif; ?>

<div class="clearfix"></div>
