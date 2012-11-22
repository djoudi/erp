<?php if ($sf_user->hasFlash('errorRowWork')): ?>
    <?php if ($sf_user->getFlash('errorRowWork') == $record['id']) $class="error"; ?>    
<?php endif ?>

<?php if (!isset($class)) $class=""; ?>

<tr class="<?php echo $class; ?>">
    
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
        <?php include_partial ('fmcCore/confirmButton', array(
            'url' => url_for ('wh_my_day_deletework', array('date'=>$date, 'id'=>$record['id']))
        )); ?>
    </td>
    
</tr>
