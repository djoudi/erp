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
                <a href="<?php echo $editurl; ?>">
                    <i class="icon-pencil"></i>
                </a> 
                
                <a href="<?php echo $deleteurl; ?>">
                    <i class="icon-trash"></i>
                </a>
            </td>
        <?php endif; ?>
        
    </tr>
    
<?php endforeach; ?>
