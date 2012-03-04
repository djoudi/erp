<form action="" method="post">
  <?php echo $form->renderHiddenFields() ?>
  <table class="table table-striped table-bordered table-condensed" id="CostFormUser_NewCfi">
    <tr>
      <th>Date</th>
      <th>Description</th>
      <th>Amount</th>
      <th>VAT (%)</th>
      <th>Receipt No</th>
      <th>Invoice To</th>
      <th>Action</th>
    </tr>
    <tr>
      <td>
        <?php echo $form['cost_Date'] ?>
        <?php if ($form['cost_Date']->renderError()):?>
          <br />
          <?php echo $form['cost_Date']->renderError() ?>
        <?php endif; ?>
      </td>
      <td>
        <?php echo $form['description'] ?>
        <?php if ($form['description']->renderError()):?>
          <br />
          <?php echo $form['description']->renderError() ?>
        <?php endif; ?>
      </td>
      <td>
        <?php echo $form['amount'] ?>
        <?php echo $form['currency_id'] ?>
        <?php if ($form['amount']->renderError()):?>
          <br />
          <?php echo $form['amount']->renderError() ?>
        <?php endif; ?>
      </td>
      <td><?php echo $form['vat_id'] ?></td>
      <td><?php echo $form['receipt_No'] ?></td>
      <td><?php echo $form['invoice_To'] ?></td>
      <td>
        <input class="btn btn-small btn-success" type="submit" value="Add" />&nbsp;
        <input class="btn btn-small" type="reset" value="Clear" />
      </td>
    </tr>
  </table>
</form>
