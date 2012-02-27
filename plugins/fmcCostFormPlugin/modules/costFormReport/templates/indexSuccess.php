<?php slot ('title', "Cost Reports") ?>


<?php if (isset($filter)): ?>
  <?php include_partial ('fmcCore/filterForm', array('filter'=>$filter, 'filtered'=>$filtered)); ?>
<?php endif; ?>


<?php if (!count($costFormItems)): ?>
  No costs found in your selected criterias.<br />
<?php else: ?>

  <table class="tablesorter table table-striped table-bordered table-condensed">
    <thead>
      <tr>
        <th>Date</th>
        <th>Employee</th>
        <th>Project</th>
        <th>Description</th>
        <th>VAT</th>
        <th>Amount</th>
        <th>Receipt No</th>
        <th>Invoice Status</th>
        <?php if ($sf_user->hasPermission('Cost Form Management')): ?>
          <th>Operations</th>
        <?php endif; ?>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($costFormItems as $cfi): ?>
        <tr>
          
          
          <td>
            <?php echo $cfi->getCostDate(); ?>
          </td>
          
          <td><?php echo $cfi->getCostForms()->getUsers()->__toString(); ?></td>
          <td><?php echo $cfi->getCostForms()->getProjects()->getCode(); ?></td>
          <td>
            <?php if (strlen($cfi->getDescription()) < 20): ?>
              <?php echo $cfi->getDescription(); ?>
            <?php else: ?>
              <a href="#" rel="tooltip" title="<?php echo $cfi->getDescription(); ?>" class="tooltips" >
                <?php echo mb_substr($cfi->getDescription(), 0, 20, "UTF-8"); ?>...
              </a>
            <?php endif; ?>
          </td>
          <td><?php echo $cfi->getVats()->getRate(); ?></td>
          <td><?php echo $cfi->getAmount()." ".$cfi->getCurrencies(); ?></td>
          <td><?php echo $cfi->getReceiptNo(); ?></td>
          <td>
           <?php if (!$cfi->getIsProcessed()): ?>
             Not processed
           <?php else: ?>
             <?php if ($cfi->getDontInvoice()): ?>
               Don't invoice
             <?php else: ?>
               <?php echo $cfi->getInvoiceNo(); ?>
             <?php endif; ?>
           <?php endif; ?>
          </td>
          <?php if ($sf_user->hasPermission('Cost Form Management')): ?>
            <td>
              <a href="<?php echo url_for('@costFormManage_edit?cost_id='.$cfi->getId()); ?>">Edit</a>&nbsp;&nbsp;
              <a onclick="
                if (confirm('Are you sure you want to delete this cost? Warning! You cannot undo this operation!'))
                  parent.location='<?php echo url_for('@costFormManage_delete?cost_id='.$cfi->getId()); ?>'
              ">Delete</a>
            </td>
          <?php endif; ?>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  
<?php endif; ?>
