<table class="tablesorter table table-striped table-bordered table-condensed">
    
    <thead>
        <tr>
            <th>Date</th>
            <th>Project</th>
            <th>Employee</th>
            <th>Description</th>
            <th>VAT</th>
            <th>excl VAT</th>
            <th>incl VAT</th>
            
            <?php if ($isinvoiced): ?>
                <th>Invoice No</th>
                <th>Invoice Date</th>
            <?php else: ?>
                <th colspan="2">Invoice Status</th>
            <?php endif; ?>
        </tr>
    </thead>
    
    <tbody>
    
    
    <?php $sumIncl = 0;?>
    <?php $sumExcl = 0;?>
    <?php foreach ($items as $cfi): ?>
      <?php $sumIncl += $cfi['amount']; ?>
      <?php #$sumExcl += $cfi->getWithoutVat(); ?>
      <tr>
        <td><?php echo $cfi['cost_Date'] ?></td>
        <td><?php #echo $cfi['CostForms']['Projects']['name'] ?></td>
        <td><?php echo $cfi->CostForms->Users ?></td>
        <td><?php echo $cfi->description ?></td>
        <td><?php echo $cfi->Vats ?></td>
        <td><?php echo $cfi->withoutVat ?> <?php echo $cfi->Currencies ?></td>
        <td><?php echo $cfi->amount ?> <?php echo $cfi->Currencies ?></td>
        <?php if ($isinvoiced): ?>
          <td><?php echo $cfi->invoice_No ?></td>
          <td><?php echo $cfi->invoice_Date ?></td>
        <?php else: ?>
          <td colspan="2">Don't Invoice</td>
        <?php endif; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="5" style="text-align: right;">Total</th>
      <th><?php echo $sumExcl; ?> <?php echo $cfi->Currencies ?></th>
      <th><?php echo $sumIncl; ?> <?php echo $cfi->Currencies ?></th>
      <td colspan="2"></td>
    </tr>
  </tfoot>
</table>
