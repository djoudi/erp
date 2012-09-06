<?php slot ('title', "Cost Reports") ?>

<script type="text/javascript">
    $("#topmenu_costforms").addClass("active");
</script>


<?php if (isset($filter)): ?>
  <?php include_partial ('fmcCore/filterForm', array(
  'filter'=>$filter, 
  'filtered'=>$filtered, 
  'count'=>count($costFormItems)
  )); ?>
<?php endif; ?>


<?php if ($resultslimited): ?>
  <div class="alert">
    <a class="close" data-dismiss="alert" href="#">×</a>
    More than <strong><?php echo $resultlimit; ?></strong> results found, showing first <strong><?php echo $resultlimit; ?></strong> results. Please filter your result.
  </div>
<?php endif; ?>


<?php if (!count($costFormItems)): ?>
  <p>No costs found in your selected criterias.</p>
<?php else: ?>

  <table class="tablesorter1d tablesorterpager table table-striped table-bordered table-condensed">
    
    <thead>
      <tr>
        <th>Date</th>
        <th>Employee</th>
        <th>Project</th>
        <th>Description</th>
        <th>Amount</th>
        <th>Receipt No</th>
        <th>Invoice Status</th>
        <?php if ($sf_user->hasPermission('Cost Form Management')): ?>
          <th></th>
        <?php endif; ?>
      </tr>
    </thead>
    
    <tbody>
      <?php foreach ($costFormItems as $cfi): ?>
        <tr>
          <td>
            <?php echo $cfi["cost_Date"]; ?>
          </td>
          
          <td>
              <?php echo $cfi["CostForms"]["Users"]["first_name"]; ?> 
              <?php echo $cfi["CostForms"]["Users"]["last_name"]; ?>
          </td>
          
            <td>
                <?php echo $cfi["CostForms"]["Projects"]["code"]; ?>
            </td>
          
          <td>
            <?php if (strlen($cfi["description"]) < 20): ?>
              <?php echo $cfi["description"]; ?>
            <?php else: ?>
              <a href="#" rel="tooltip" title="<?php echo $cfi["description"]; ?>" class="tooltips" >
                <?php echo mb_substr($cfi["description"], 0, 20, "UTF-8"); ?>...
              </a>
            <?php endif; ?>
          </td>
          <td>
            <?php echo $cfi["amount"]." ".$cfi["Currencies"]["code"]; ?>
          </td>
          <td><?php echo $cfi["receipt_No"]; ?></td>
          
          <td>
           <?php if (!$cfi["is_Processed"]): ?>
             Not invoiced
           <?php else: ?>
             <?php if ($cfi["dontInvoice"]): ?>
               Don't invoice
             <?php else: ?>
               <?php echo $cfi["invoice_No"]; ?>
               <?php if ($cfi["invoice_Date"]): ?>
                 (<?php echo $cfi["invoice_Date"]; ?>)
               <?php endif; ?>
             <?php endif; ?>
           <?php endif; ?>
          </td>
          
          <?php if ($sf_user->hasPermission('Cost Form Management')): ?>
            <td>
              <?php
                $editurl = url_for('@costFormManage_edit?cost_id='.$cfi["id"]);
                $deleteurl = url_for('@costFormManage_delete?cost_id='.$cfi["id"]);
              ?>
              <a href="<?php echo $editurl; ?>"><i class="icon-pencil"></i></a> 
              <a href="#" onclick="
                if (confirm('Are you sure you want to delete this cost? Warning! You cannot undo this operation!'))
                  parent.location='<?php echo $deleteurl; ?>'
              "><i class="icon-trash"></i></a> 
            </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
    
  </table>
  
<?php endif; ?>
