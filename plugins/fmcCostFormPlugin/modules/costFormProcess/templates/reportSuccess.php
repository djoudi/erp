<?php slot ('title', "Invoicing Report") ?>

<a class="btn btn-primary pull-right" href="<?php echo url_for("@costFormProcess_export"); ?>">Download Report</a>

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
  <li class="active"><a href="#invoiced" data-toggle="tab">To be invoiced</a></li>
  <li><a href="#notInvoiced" data-toggle="tab">NOT to be invoiced</a></li>
</ul>
 
<div class="tab-content">
  
  <div class="tab-pane active" id="invoiced">
    
    <h3>Costs selected to be invoiced</h3>
    
    <?php if (!count($invoiced)): ?>
      <p>No costs selected to be invoiced.</p>
    <?php else: ?>
      <p><strong><?php echo count($invoiced); ?></strong> costs selected to be invoiced.</p>
      <?php include_partial ('reportlist', array('list'=>$invoiced)); ?>
    <?php endif; ?>
    
  </div>
  
  <div class="tab-pane" id="notInvoiced">
    
    <h3>Costs selected not to be invoiced</h3>
    
    <?php if (!count($notInvoiced)): ?>
      <p>No costs selected NOT to be invoiced.</p>
    <?php else: ?>
      <p><strong><?php echo count($notInvoiced); ?></strong> costs selected NOT to be invoiced.</p>
      <?php include_partial ('reportlist', array('list'=>$notInvoiced)); ?>
    <?php endif; ?>
    
  </div>
  
</div>
