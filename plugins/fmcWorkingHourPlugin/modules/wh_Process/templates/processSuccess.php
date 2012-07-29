<?php slot ('title', "Processing leave request"); ?>


<form method="post">
    
    <table class="table table-bordered table-condensed table-striped">
        <?php echo $form; ?>
    </table>

    <div class="clear"></div>

    <div class="form-actions">
        
        <?php if ($leave ['status'] =='Pending'): ?>
        
            <input type="submit" value="Save Changes" class="btn btn-primary" />
        
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
