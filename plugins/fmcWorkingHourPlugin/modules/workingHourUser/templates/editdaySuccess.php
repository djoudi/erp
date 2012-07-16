<?php include_partial ('title', array('date'=>$date, 'text'=>'Working Hours')); ?>

<table class="table table-condensed table-bordered">
    <tr>
        <th>Office entrance</th>
        <td><?php echo $entranceHour["time"]; ?></td>
    </tr>
</table>    

<p>Note: To change office entrance hour, you have to delete this day.</p>

<hr />

<table class="table table-condensed table-bordered">  
    
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
        <?php include_partial ("dayitems_list", array("items"=>$items)); ?>
    </tbody>
    
    <tfoot>
        <?php include_partial ("dayitems_new", array("form"=>$form)); ?>
    </tfoot>  
    
</table>
