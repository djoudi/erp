<?php foreach($items as $item): ?>

    <tr>
        <td>
            <?php echo $item->getProject(); ?>
        </td>
        
        <td>
            <?php echo date("H:i", strtotime($item->getStart())); ?>
        </td>
        
        <td>
            <?php echo date("H:i", strtotime($item->getEnd())); ?>
        </td>
        
        <td>
            <?php echo $item->getTimeDifference(); ?>
        </td>
        
        <td>
            <?php echo $item->getWorkType(); ?>
        </td>
        
        <td>
            <?php echo $item->getComment(); ?>
        </td>
        
        <?php if ($edit): ?>        
            <td>
                <a href="<?php echo url_for('@wh_user_deleteitem?id='.$item["id"]); ?>">
                    <i class="icon-trash"></i>
                </a>
            </td>
        <?php endif; ?>
        
    </tr>
    
<?php endforeach; ?>
