<?php if ($sf_user->hasFlash('errorRowIO')): ?>
    <?php if ($sf_user->getFlash('errorRowIO') == $record['id']) $class="error"; ?>    
<?php endif ?>

<?php if (!isset($class)) $class=""; ?>

<tr class="<?php echo $class; ?>">
    
    <td colspan="2" style="text-align: center;">
        <strong>
            <?php echo $record["type"]; ?>
        </strong>
    </td>
    
    <td>
        <strong>
            <?php echo $record["time"]; ?>
        </strong>
    </td>
    
    <td colspan="2">
        
    </td>
    
    <?php if ($isDraft): ?>
        <td>
            <?php include_partial ('fmcCore/confirmButton', array(
                'url' => url_for ('wh_my_day_deleteio', array('date'=>$date, 'id'=>$record['id']))
            )); ?>
        </td>
    <?php endif; ?>
    
</tr>
