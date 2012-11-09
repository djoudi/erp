<a class="btn btn-danger btn-small pull-right" onclick="
      if (confirm('If you continue, all records for today will be DELETED. Are you sure?'))
        parent.location='<?php echo $dayDeleteUrl; ?>'
">
    <i class="icon-remove icon-white"></i>
    Delete Day
</a>


<table class="table table-bordered table-hover table-condensed pull-left">
    
    <thead>
        <tr>
            <th>Project</th>
            <th>Type of Work</th>
            <th>From</th>
            <th>To</th>
            <th>Comments</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php include_partial ('ioline', array('record'=>$dayIOrecords[0]) ); ?>
        
        <?php $j=1; foreach ($dayWorkRecords as $work): ?>
            
            <?php while ($dayIOrecords[$j]["time"] < $work["start"] ): ?>
                <?php include_partial ('ioline', array('record'=>$dayIOrecords[$j]) ); ?>
                <?php $j++; ?>
            <?php endwhile; ?>
            
            <tr>
                <td><?php echo $work->getProject(); ?></td>
                <td><?php echo $work->getWorkType(); ?></td>
                <td><?php echo $work->getStart(); ?></td>
                <td><?php echo $work->getEnd(); ?></td>
                <td><?php echo $work->getComment(); ?></td>
            </tr>
            
        <?php endforeach; ?>
    
        <?php for ($i = $j; $i<count($dayIOrecords); $i++): ?>
            <?php include_partial ('ioline', array('record'=>$dayIOrecords[$i]) ); ?>
        <?php endfor; ?>
    
    </tbody>

</table>




    <?php /*
    <tfoot>
        <tr>
            <form class="form-inline" method="post">
                <?php echo $form->renderHiddenFields(); ?>
                <td><?php echo $form['project_id']; ?></td>
                <td><?php echo $form['type_id']; ?></td>
                <td><?php echo $form['start']; ?></td>
                <td><?php echo $form['end']; ?></td>
                <td><?php echo $form['comment']; ?></td>
                <td><input class="btn btn-mini" type="submit" value="Add"/></td>
            </form>
        </tr>
    </tfoot>
    */ ?>
