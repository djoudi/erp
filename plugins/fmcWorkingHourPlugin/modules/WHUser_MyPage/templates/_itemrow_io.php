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
    
    <td>
        <?php if ($last): ?>
            <?php include_partial ('fmcCore/deleteConfirm', array(
                'url' => url_for ('wh_user_day_deleteio', array('date'=>$date, 'id'=>$record['id']))
            )); ?>
        <?php endif; ?>
    </td>
    
</tr>
