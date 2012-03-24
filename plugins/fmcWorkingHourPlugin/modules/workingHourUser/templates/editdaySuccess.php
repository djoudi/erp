<?php include_partial ('title', array('date'=>$date)); ?>

<table class="table table-condensed">  
  <thead>
    <tr>
      <th>Project</th>
      <th>From</th>
      <th>To</th>
      <th>Total</th>
      <th>Type of Work</th>
      <th>Comments</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($items as $item): ?>
      <?php $type = $item->getType(); ?>
      <?php if ($type=='Enter' or $type=='Exit'): ?>
        <tr>
          <td></td>
          <td><?php if ($type=='Enter'): ?><?php echo $item->getStart(); ?><?php endif; ?></td>
          <td><?php if ($type=='Exit'): ?><?php echo $item->getEnd(); ?><?php endif; ?></td>
          <td></td>
          <td><?php echo $type; ?> Work</td>
          <td></td>
          <td></td>
        </tr>
      <?php else: ?>
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
      <?php endif; ?>
    <?php endforeach; ?>
  </tbody>
  <tfoot>
    <?php include_partial ("itemnew", array("form"=>$form)); ?>
  </tfoot>  
</table>


<a class="btn" href="<?php echo url_for('workingHourUser_editday_enterance', array('date'=>$date)); ?>">Add new enterance</a>
<a class="btn" href="<?php echo url_for('workingHourUser_editday_exit', array('date'=>$date)); ?>">Add new exit</a>


