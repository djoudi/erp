<?php slot ('title', "Invoicing Report") ?>



<table class="bordered-table">
  <tr>
    <th>Company</th>
    <td><?php echo $project->Customers ?></td>
  </tr>
  <tr>
    <th>Project</th>
    <td><?php echo $project ?></td>
  </tr>
</table>



<h3>Costs selected to be invoiced</h3>

<?php if (!count($invoiced)): ?>
  No costs selected to be invoiced.
<?php else: ?>

  <table class="tablesorter bordered-table zebra-striped">
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
      <?php foreach ($invoiced as $cfi): ?>
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
  </table>
<?php endif; ?>

<p>&nbsp;</p>

<h3>Costs selected not to be invoiced</h3>

<?php if (!count($notInvoiced)): ?>
  No costs selected NOT to be invoiced.
<?php else: ?>
  <table class="tablesorter bordered-table zebra-striped">
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
      <?php foreach ($notInvoiced as $cfi): ?>
        <tr>
          <td><?php echo $cfi->cost_Date ?></td>
          <td><?php echo $cfi->CostForms->Projects ?></td>
          <td><?php echo $cfi->CostForms->Users ?></td>
          <td><?php echo $cfi->description ?></td>
          <td><?php echo $cfi->Vats ?></td>
          <td><?php echo $cfi->withoutVat ?> <?php echo $cfi->Currencies ?></td>
          <td><?php echo $cfi->amount ?> <?php echo $cfi->Currencies ?></td>
          <td>Don't Invoice</td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
<?php endif; ?>

<div class="actions">
  <a class="btn primary" href="<?php echo url_for("@costFormProcess_export"); ?>">Print to Excel</a>
</div>





