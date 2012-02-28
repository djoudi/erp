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
      <th>Invoice No</th>
    </tr>
  </thead>
  <tbody>
    <?php $sumIncl = 0;?>
    <?php $sumExcl = 0;?>
    <?php foreach ($list as $cfi): ?>
      <?php $sumIncl += $cfi->getAmount(); ?>
      <?php $sumExcl += $cfi->getWithoutVat(); ?>
      <tr>
        <td><?php echo $cfi->cost_Date ?></td>
        <td><?php echo $cfi->CostForms->Projects ?></td>
        <td><?php echo $cfi->CostForms->Users ?></td>
        <td><?php echo $cfi->description ?></td>
        <td><?php echo $cfi->Vats ?></td>
        <td><?php echo $cfi->withoutVat ?> <?php echo $cfi->Currencies ?></td>
        <td><?php echo $cfi->amount ?> <?php echo $cfi->Currencies ?></td>
        <td><?php echo $cfi->invoice_No ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <th colspan="5" style="text-align: right;">
        Total
      </th>
      <th>
        <?php echo $sumExcl; ?> <?php echo $cfi->Currencies ?>
      </th>
      <th>
        <?php echo $sumIncl; ?> <?php echo $cfi->Currencies ?>
      </th>
      <td></td>
    </tr>
  </tfoot>
</table>
