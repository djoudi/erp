<?php slot ('title', "Edit Cost Form") ?>


<?php slot ('activeClass', "#topmenu_costforms"); ?>


<table class="table table-bordered table-condensed table-hover">
    
    <tr>
        <th>User</th>
        <td>
            <?php echo $costform->getUsers(); ?>
        </td>
    </tr>
    
    <tr>
        <th>Project</th>
        <td>
            <?php echo $costform->getProjects(); ?>
        </td>
    </tr>
    
    <tr>
        <th>Advance Received</th>
        <td>
            <?php echo $costform->getCurrencies(); ?> 
            <?php echo $costform['advanceReceived']; ?>
        </td>
    </tr>


</table>

<h4>Costs for this form</h4>

<table class="tablesorter table table-bordered table-condensed table-hover">
    
    <thead>
        <tr>
            <th>Date</th>
            <th>Description</th>
            <th>Amount</th>
            <th>VAT</th>
            <th>Receipt No</th>
            <th>Status</th>
        </tr>
    
    </thead>
    
    <tbody>
        <?php foreach ($costform->getCostFormItems() as $item): ?>
            <tr>
                <td>
                    <?php echo $item['cost_Date']; ?>
                </td>
                
                <td>
                    <a href="<?php echo url_for('costFormManage_edit',array('cost_id'=>$item['id'])); ?>">
                        <?php echo $item['description']; ?>
                    </a>
                </td>
                
                <td data-value="<?php echo $item["amount"]; ?>">
                    <?php echo $item["Currencies"]["code"]; ?> 
                    <?php echo $item["amount"]; ?>
                </td>
                
                <td>
                    % <?php echo $item['Vats']['rate']; ?>
                </td>
                
                <td>
                    <?php echo $item['receipt_No']; ?>
                </td>
                
                <td>
                    <?php if ($item['is_Processed']): ?>
                        Invoiced
                    <?php else: ?>
                        Not invoiced
                    <?php endif; ?>
                </td>
                
            </tr>
        <?php endforeach; ?>
    </tbody>

</table>    

<div class="form-actions">

    <?php include_partial ('fmcCore/confirmButton', array(
        'class' => 'btn btn-danger pull-right',
        'url' => url_for('costFormManage_costformdelete',array('id'=>$costform['id'])),
        'label' => 'Delete Cost Form',
        "iconClass" => 'icon-remove icon-white'
    )); ?>

</div>
