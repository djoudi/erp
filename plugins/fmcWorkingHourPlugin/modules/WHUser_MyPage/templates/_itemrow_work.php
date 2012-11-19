<tr>
    
    <td>
        <?php echo $record->getProject(); ?>
    </td>
    
    <td>
        <?php echo $record->getWorkType(); ?>
    </td>
    
    <td>
        <?php echo $record->getStart(); ?>
    </td>
    
    <td>
        <?php echo $record->getEnd(); ?>
    </td>
    
    <td>
        <?php echo $record->getComment(); ?>
    </td>
    
    <td>
    
        <?php $deleteUrl = url_for ('wh_user_day_deletework', array('date'=>$date, 'id'=>$record['id'])); ?>
        
        <a onclick="
            if (confirm('Are you sure you want to delete this record?'))
                parent.location='<?php echo $deleteUrl; ?>'
        ">
            Delete
        </a>
        
    </td>
    
</tr>
