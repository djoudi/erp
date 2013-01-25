<?php slot ('title', "Invoicing Report") ?>


<?php slot ('activeClass', "#topmenu_costforms"); ?>


<table class="table table-striped table-bordered table-condensed">
    <tr>
        <th>Invoice Date</th>
        <td><?php echo $invoicing->Employee ?></td>
    </tr>
    <tr>
        <th>Invoiced By</th>
        <td><?php echo $invoicing->invoicing_Date ?></td>
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
            
            <a class="btn btn-primary pull-right" href="<?php echo url_for("@costFormProcess_export?id=".$invoicing['id']); ?>">Download Report</a>
            
            <h4>Costs selected to be invoiced</h4>
            
            <p><strong><?php echo $invoicedCount; ?></strong> costs selected to be invoiced.</p>
            
            <?php foreach ($invoiced as $items): ?>
            
                <?php if (count($items)>0): ?>
                    <?php include_partial ('reportlist', array('items'=>$items, 'isinvoiced'=>true)); ?>
                <?php endif; ?>
                
            <?php endforeach; ?>
        
        </div>

    <?php endif ;?>


    <?php if ($notInvoicedCount): ?>
    
        <div class="tab-pane <?php if (!$invoicedCount): ?>active<?php endif; ?>" id="notInvoiced">
            
            <h4>Costs selected not to be invoiced</h4>
            
            <p><strong><?php echo $notInvoicedCount; ?></strong> costs selected NOT to be invoiced.</p>
            
            <?php foreach ($notInvoiced as $items): ?>
            
                <?php if (count($items)>0): ?>
                    <?php include_partial ('reportlist', array('items'=>$items, 'isinvoiced'=>false)); ?>
                <?php endif; ?>
                
            <?php endforeach; ?>
        
        </div>

    <?php endif ;?>

</div>
