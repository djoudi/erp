<?php slot ('title', "VAT Management") ?>

<?php if (!count ($list)): ?>
  <p>No VAT rate defined on the system. Please add a VAT value from below.</p>
<?php else: ?>

  <table class="tablesorter bordered-table zebra-striped">
  
    <thead>
      <tr>
        <th>Rate</th>
        <th>Is Default?</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    
    <tbody>
      <?php foreach ($list as $vat): ?>
        <tr>
          <td><?php echo $vat->getRate() ?></td>
          <td><?php if ($vat->getIsDefault()): ?>Default<?php endif; ?></td>
          <td>
            <?php if ($vat->getIsActive()): ?>
              <span class="label success">Enabled</span>
            <?php else: ?>
              <span class="label important">Disabled</span>
            <?php endif; ?>
          </td>
          
          <td>
            <?php if ($vat->getIsActive()): ?>
              <a class="btn little" href="<?php echo url_for('@vatManagement_disable?id='.$vat->getId()); ?>">Disable</a>
            <?php else: ?>
              <a class="btn little" href="<?php echo url_for('@vatManagement_enable?id='.$vat->getId()); ?>">Enable</a>
            <?php endif; ?>
            
            <?php if (!$vat->getIsDefault()): ?>
              <a class="btn little success" href="<?php echo url_for('@vatManagement_makeDefault?id='.$vat->getId() ); ?>">Make Default</a>
            <?php endif; ?>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  
<?php endif; ?>

<form action="" method="post">
  
<?php echo $form->renderHiddenFields() ?>
  
  <div class="actions">
  
    <h4>Add new VAT</h4>
  
    Rate&nbsp;
    <?php echo $form['rate'] ?>&nbsp;
    <input class="btn success" type="submit" value="Add" />
  </div>
  
</form>
