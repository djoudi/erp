<?php slot ('title', "Invoicing Report") ?>


<?php slot ('activeClass', "#topmenu_costforms"); ?>


<?php if ($invoicedCount): ?>

    <a class="btn btn-primary pull-right" href="<?php echo url_for("@costFormProcess_export"); ?>">Download Report</a>
    
<?php endif; ?>


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


<ul class="nav nav-tabs">
    <?php if ($invoicedCount and $notInvoicedCount): ?>
        <li class="active"><a href="#invoiced" data-toggle="tab">To be invoiced</a></li>
        <li><a href="#notInvoiced" data-toggle="tab">NOT to be invoiced</a></li>
    <?php endif; ?>
</ul>


<div class="tab-content">
  
  <?php if ($invoicedCount): ?>
    <div class="tab-pane active" id="invoiced">
      <h3>Costs selected to be invoiced</h3>      
      <p><strong><?php echo $invoicedCount; ?></strong> costs selected to be invoiced.</p>
      <?php foreach ($invoiced as $currency_id=>$list): ?>
        <?php if (count($list)>0): ?>
          <?php include_partial ('reportlist', array('list'=>$list, 'isinvoiced'=>true)); ?>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  <?php endif ;?>

  <?php if ($notInvoicedCount): ?>
    <div class="tab-pane <?php if (!$invoicedCount): ?>active<?php endif; ?>" id="notInvoiced">
      <h3>Costs selected not to be invoiced</h3>
      <p><strong><?php echo $notInvoicedCount; ?></strong> costs selected NOT to be invoiced.</p>
      <?php foreach ($notInvoiced as $currency_id=>$list): ?>
        <?php if (count($list)>0): ?>
          <?php include_partial ('reportlist', array('list'=>$list, 'isinvoiced'=>false)); ?>
        <?php endif; ?>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
  
</div>
