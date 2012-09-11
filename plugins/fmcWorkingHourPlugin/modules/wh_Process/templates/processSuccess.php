<?php slot ('title', "Processing leave request"); ?>

<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>


<form method="post">
    
    <table class="table table-bordered table-condensed table-striped">
        <tr>
            <th>Employee</th>
            <td><?php print $leave->getUser(); ?></td>
        </tr>
        <tr>
            <th>Status</th>
            <td><?php echo $leave["status"]; ?></td>
        </tr>
        <tr>
            <th>From Date</th>
            <td><?php echo $leave["from_Date"]; ?></td>
        </tr>
        <tr>
            <th>To Date</th>
            <td><?php echo $leave["to_Date"]; ?></td>
        </tr>
        <tr>
            <th>Type</th>
            <td><?php echo $leave["type"]; ?></td>
        </tr>
        
        <?php echo $form; ?>
        
    </table>

    <div class="clear"></div>

    <div class="form-actions">
        
        <a class="btn" href="<?php echo url_for('@wh_process_leaverequests'); ?>">Back to List</a>
        
        <input type="submit" value="Save Changes" class="btn btn-primary" />
        
        <?php if ($leave ['status'] =='Pending'): ?>
        
            <div class="pull-right">
        
                <a class="btn btn-success" onclick="
                  if (confirm('Are you sure you want to approve this leave request?'))
                    parent.location='<?php echo $approveUrl; ?>'
                ">Approve Request</a>
                
                <a class="btn btn-danger" onclick="
                  if (confirm('Are you sure you want to deny this leave request?'))
                    parent.location='<?php echo $denyUrl; ?>'
                ">Deny Request</a>
            
            </div>
            
        <?php endif; ?>
      
        <div class="clear"></div>
      
    </div>

</form>
