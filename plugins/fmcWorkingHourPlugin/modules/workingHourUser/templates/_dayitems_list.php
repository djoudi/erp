<?php foreach($items as $item): ?>

    <tr>
        <td><?php echo $item->getProject(); ?></td>
        <td><?php echo date("H:i", strtotime($item->getStart())); ?></td>
        <td><?php echo date("H:i", strtotime($item->getEnd())); ?></td>
        <td><?php echo $item->getTimeDifference(); ?></td>
        <td><?php echo $item->getWorkType(); ?></td>
        <td><?php echo $item->getComment(); ?></td>
        <td>
            <?php $editurl = url_for('workingHourUser_edititem', array('date' => $date,'item_id' => $item->getId())); ?>
            <a href="<?php echo $editurl; ?>">
                <i class="icon-pencil"></i>
            </a> 
            
            <?php $deleteurl = url_for('workingHourUser_deleteitem', array('item_id'=>$item->getId())); ?>
            <a href="<?php echo $deleteurl; ?>">
                <i class="icon-trash"></i>
            </a>
        </td>
    </tr>
    
<?php endforeach; ?>
