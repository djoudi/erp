<?php slot ('title', "Currency Management"); ?>

<?php if (!count ($list)): ?>
  <p>No currency defined on the system. Please add a currency value from below.</p>
<?php else: ?>

  <table class="tablesorter table table-striped table-bordered table-condensed">
    <thead>
      <tr>
        <th>Code</th>
        <th>Symbol</th>
        <th>Is Default?</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($list as $currency): ?>
        <tr>
          <td><?php echo $currency->getCode() ?></td>
          <td><?php echo $currency->getSymbol() ?></td>
          <td><?php if ($currency->getIsDefault()): ?>Default<?php endif; ?></td>
          <td>
            <?php if ($currency->getIsActive()): ?>
              <span class="label label-success">Enabled</span>
            <?php else: ?>
              <span class="label label-important">Disabled</span>
            <?php endif; ?>
          </td>
          <td>
            <?php if ($currency->getIsActive()): ?>
              <a class="btn btn-mini" href="<?php echo url_for('@currencyManagement_disable?id='.$currency->getId()); ?>">Disable</a>
            <?php else: ?>
              <a class="btn btn-mini" href="<?php echo url_for('@currencyManagement_enable?id='.$currency->getId()); ?>">Enable</a>
            <?php endif; ?>
            <?php if (!$currency->getIsDefault()): ?>
              <a class="btn btn-mini btn-success" href="<?php echo url_for('@currencyManagement_makeDefault?id='.$currency->getId()); ?>">Make Default</a>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  
<?php endif; ?>


<form action="" method="post">
  <?php echo $form->renderHiddenFields() ?>
  <div class="form-actions">
  
    <h4>Add new currency</h4>
    
    Code&nbsp;
    <?php echo $form["code"]; ?>&nbsp;
    Symbol&nbsp;
    <?php echo $form["symbol"]; ?>&nbsp;
    <input class="btn btn-primary" type="submit" value="Add" />
    
  </div>
  
</form>
