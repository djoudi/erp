<?php slot ('title', "Cost Reports") ?>

<form method="post" action="">
  <table class="table table-striped table-bordered table-condensed">
    <?php echo $filter; ?>
    <tr>
      <td></td>
      <td style="text-align: right;">
        <input class="btn" type="submit" name="_reset" value="Show All" />
        <input class="btn btn-info" type="submit" value="Filter" />&nbsp;
      </td>
    </tr>
  </table>
</form>

<h3>Results</h3>  
  
<?php if (!count($costFormItems)): ?>
  No costs found in your selected criterias.<br />
<?php else: ?>

  <table class="tablesorter table table-striped table-bordered table-condensed">
    <thead>
      <tr>
        <th>Cost No</th>
        <th>CF No</th>
        <th>Employee</th>
        <th>Project</th>
        <th>Description</th>
        <th>VAT</th>
        <th>Amount (inc Vat)</th>
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
          <td><?php echo $cfi->getId(); ?></td>
          <td><?php echo $cfi->getCostForms()->getId(); ?></td>
          <td><?php echo $cfi->getCostForms()->getUsers()->__toString(); ?></td>
          <td><?php echo $cfi->getCostForms()->getProjects()->getCode(); ?></td>
          <td><?php echo $cfi->getDescription(); ?></td>
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
