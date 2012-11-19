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
        <?php include_partial ('fmcCore/deleteConfirm', array(
            'url' => url_for ('wh_user_day_deletework', array('date'=>$date, 'id'=>$record['id']))
        )); ?>
    </td>
    
</tr>
