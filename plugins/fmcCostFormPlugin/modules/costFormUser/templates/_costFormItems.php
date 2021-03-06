<?php if (count($costItems) ): ?>
  
  
  
  
  
  <table class="tablesorter table table-striped table-bordered table-condensed pull-right">
    <thead>
      <tr>
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
          <th>Invoice Status</th>
          <th>Payment Status</th>
        <?php endif; ?>
        
      </tr>
    </thead>
    <tbody>
      <?php foreach ($costItems as $index => $costItem): ?>
        <tr>
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
            <td>
              <?php
                $url = url_for('costFormUser_editItem', array(
                  'id' => $costItem->getCostForms()->getId(), 
                  'cfi_id' => $cfi_id = $costItem['id']
                ));
              ?>
                <a href="<?php echo $url; ?>"><i class="icon-pencil"></i></a> 
              <?php $url = url_for('@costFormUser_deleteItem?id='.$costItem['id']); ?>
                <a href="<?php echo $url; ?>"><i class="icon-trash"></i></a> 
            </td>
          <?php endif;?>
          
          <?php if ($isSent): ?>
            <td>
              <?php if ($costItem->dontInvoice): ?>
                Don't Invoice
              <?php elseif ($costItem->getInvoice_No()): ?>
                <?php echo $costItem->getInvoice_No(); ?>
                <?php if ($costItem->invoice_Date): ?>
                   (<?php echo $costItem->invoice_Date; ?>)
                <?php endif; ?>
              <?php else: ?>
                Not invoiced yet
              <?php endif; ?>
            </td>
            
            <td>
              <?php if ($costItem->getIsPaid()): ?>
                <span class="label label-success">Paid</span>
              <?php else: ?>
                <span class="label label-important">Unpaid</span>
              <?php endif; ?>
              <a href="<?php echo url_for("@costFormUser_changepaidstatus?id=".$costItem->getId()); ?>"> (Change)</a>
          <?php endif; ?>
          
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  
<?php else: ?>
  No cost items found.<br />
<?php endif; ?>
