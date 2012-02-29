<?php slot ('title', "Invoicing Cost Forms") ?>


  <?php if (!count($costFormItems)): ?>
    <p>No cost forms found in your selected criterias.</p>
    <a class="btn btn-info" href="<?php echo url_for("@costFormProcess_filter"); ?>">Go back</a>
    
  <?php else: ?>
    
    <table class="table table-striped table-bordered table-condensed">
      <tr>
        <th>Company</th>
        <td><?php echo $project->Customers ?></td>
      </tr>
      <tr>
        <th>Project</th>
        <td><?php echo $project ?></td>
      </tr>
    </table>
    
    
    
    
    <p><strong><?php echo count($costFormItems); ?></strong> costs found.</p>
    
    <form method="post" action="">
      <table class="tablesorter table table-striped table-bordered table-condensed">
        <thead>
          <tr>
            <th>Date</th>
            <th>Employee</th>
            <th>Description</th>
            <th>Tax</th>
            <th>Excl VAT</th>
            <th>Incl VAT</th>
            <th>Invoice To</th>
            <th>Don't Invoice</th>
            <th>Invoice No</th>
            <th>Invoice Date</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($costFormItems as $cfi): ?>
            <tr>
              <td><?php echo $cfi->cost_Date ?></td>
              <td><?php echo $cfi->CostForms->Users ?></td>
              <td>
                <?php if (strlen($cfi->getDescription()) < 20): ?>
                  <?php echo $cfi->getDescription(); ?>
                <?php else: ?>
                  <a href="#" rel="tooltip" title="<?php echo $cfi->getDescription(); ?>" class="tooltips" >
                    <?php echo mb_substr($cfi->getDescription(), 0, 20, "UTF-8"); ?>...
                  </a>
                <?php endif; ?>
              </td>
              <td>%<?php echo $cfi->Vats ?></td>
              <td><?php echo $cfi->withoutVat ?> <?php echo $cfi->Currencies ?></td>
              <td><?php echo $cfi->amount ?> <?php echo $cfi->Currencies ?></td>
              <td><?php echo $cfi->invoice_To ?></td>
              <td><label class="w100"><input class="tbi inline" type="checkbox" name="<?php echo $cfi->id ?>[toBeInvoiced]" value="dni" /> Don't Invoice</label></td>
              <td><input class="w100" name="<?php echo $cfi->id ?>[invoice_No]" type="text" /></td>
              <td><input class="w100 datepick" name="<?php echo $cfi->getId(); ?>[invoice_Date]" type="text" /></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
      
      <div class="form-actions">
        <input class="btn btn-success" type="submit" name="process" value="Process" />
      </div>
      
    </form>
  <?php endif; ?>

<script type="text/javascript">
$(".tbi").change(function(){
	  if ($(this).attr('checked')) {
      $(this).parent().parent().next().children().attr('disabled', true);
      $(this).parent().parent().next().next().children().attr('disabled', true);
    }
	  else {
      $(this).parent().parent().next().children().attr('disabled', false);
      $(this).parent().parent().next().next().children().attr('disabled', false);
    }
});
</script>

