<?php include_partial ('title', array('date'=>$date, 'text'=>'Working Hours')); ?>

<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>


<div class="pull-right">
    
    <p>Note: To change office entrance hour, you have to delete this day.</p>
    
    <a class="btn btn-danger btn-small pull-right" onclick="
          if (confirm('If you continue, all records for today will be DELETED. Are you sure?'))
            parent.location='<?php echo $cancelUrl; ?>'
    ">
        <i class="icon-remove icon-white"></i>
        Delete Day
    </a>
    
</div>


<table class="table table-condensed table-bordered">
    <tr>
        <th>Office entrance</th>
        <td><?php echo $entranceHour["time"]; ?></td>
    </tr>
    <tr>
        <th>Office exit</th>
        <td>
            <?php echo $exitHour["time"]; ?>
             <a href="<?php echo $exitUrl; ?>">(change)</a>
        </td>
    </tr>
</table>


<div class="clear"></div>


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
        <?php include_partial ("dayitems_list", array("items"=>$items, "edit"=>true)); ?>
    </tbody>
    
    <tfoot>
        <?php include_partial ("dayitems_new", array("form"=>$form)); ?>
    </tfoot>  
    
</table>
