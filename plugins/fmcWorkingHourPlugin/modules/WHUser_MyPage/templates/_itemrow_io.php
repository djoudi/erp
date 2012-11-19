<tr style="background-color: #efefff;">
    
    <th colspan="2" style="text-align: center;">
        <?php echo $record["type"]; ?>
    </th>
    
    <th>
        <?php echo $record["time"]; ?>
    </th>
    
    <td colspan="2">
        
    </td>
    
    <td>
        <?php include_partial ('fmcCore/deleteConfirm', array(
            'url' => url_for ('wh_user_day_deleteio', array('date'=>$date, 'id'=>$record['id']))
        )); ?>
    </td>
    
</tr>
