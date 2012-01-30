<?php if (count($costItems) ): ?>
  
  <h4>Added costs</h4>
  
  <table class="tablesorter bordered-table zebra-striped">
    <thead>
      <tr>
        <th>Cost Id</th>
        <th>Date</th>
        <th>Description</th>
        <th>Amount</th>
        <th>VAT</th>
        <th>Receipt No</th>
        <th>Invoice To</th>
        
        <?php if ( ! $isSent ): ?>
          <th>Action</th>
        <?php endif; ?>
        
        <?php if ($isSent): ?>
          <th>Payment Staus</th>
        <?php endif; ?>
        
      </tr>
    </thead>
    <tbody>
      <?php foreach ($costItems as $index => $costItem): ?>
        <tr>
          <td><?php echo $index+1 ?></td>
          <td><?php echo $costItem['cost_Date'] ?></td>
          <td><?php echo $costItem['description'] ?></td>
          <td>
            <?php echo $costItem['amount'] ?>
            <?php echo $costItem->getCurrencies() ?>
          </td>
          <td>%<?php echo $costItem['Vats'] ?></td>
          <td><?php echo $costItem['receipt_No'] ?></td>
          <td><?php echo $costItem['invoice_To'] ?></td>
          
          <?php if ( ! $isSent ): ?>
            <td><a class="btn little error" href="<?php echo url_for('@costFormUser_deleteItem?&id='.$costItem['id']) ?>">Delete</a></td>
          <?php endif;?>
          
          <?php if ($isSent): ?>
            <td>
              <?php if ($costItem->getIsPaid()): ?>
                <span class="label success">Paid</span>
              <?php else: ?>
                <span class="label">Unpaid</span>
              <?php endif; ?>
              <a href="<?php echo url_for("@costFormUser_changepaidstatus?id=".$costItem->getId()); ?>">Change</a>
          <?php endif; ?>
          
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  
<?php else: ?>
  No cost items found.<br />
<?php endif; ?>
