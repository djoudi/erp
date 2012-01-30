<?php slot ('title', "Cost Reports") ?>

<form method="post" action="">
  <table class="bordered-table zebra-striped">
    <?php echo $filter; ?>
    <tr>
      <td></td>
      <td style="text-align: right;">
        <input class="btn little" type="submit" name="_reset" value="Show All" />
        <input class="btn little info" type="submit" value="Filter" />&nbsp;
      </td>
    </tr>
  </table>
</form>

<h3>Results</h3>  
  
<?php if (!count($costFormItems)): ?>
  No costs found in your selected criterias.<br />
<?php else: ?>

  <table class="tablesorter zebra-striped bordered-table">
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
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  
<?php endif; ?>
