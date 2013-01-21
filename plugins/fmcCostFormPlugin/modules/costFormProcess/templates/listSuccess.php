<?php slot ('title', "Invoicing Cost Forms") ?>


<?php slot ('activeClass', "#topmenu_costforms"); ?>


<?php if (isset($filter)): ?>
    <?php include_partial ('fmcCore/filterForm', array(
        'filter'=>$filter, 
        'filtered'=>$filtered, 
        'count'=>count($costFormItems),
        'new_url'=>url_for('@costFormProcess_filter'),
        'new_text'=>"Back to Project Selection",
        'limit'=>$resultLimit
    )); ?>
<?php endif; ?>


<form method="post" class="form-inline">

<table class="table table-bordered table-condensed table-hover pull-left">
    <tr>
        <th>Company</th>
        <td><?php echo $project->Customers ?></td>
    </tr>
    <tr>
        <th>Project</th>
        <td><?php echo $project ?></td>
    </tr>
</table>

<?php if (count($costFormItems)): ?>


    
    <input class="btn btn-success pull-right" type="submit" name="process" value="Process" />
    
    <div class="clearfix"></div>
    
    <table class="tablesorter table table-hover table-bordered table-condensed">
        
        <thead>
            <tr>
                <th>Date</th>
                <th>Employee</th>
                <th>Description</th>
                <th>Tax</th>
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
                    
                    <td>
                        <?php echo $cfi['cost_Date']; ?>
                    </td>
                    
                    <td>
                        <?php echo $cfi['CostForms']['Users']['first_name']; ?> 
                        <?php echo $cfi['CostForms']['Users']['last_name']; ?>
                    </td>
                    
                    <td class="w250">
                        <?php echo $cfi['description']; ?>
                    </td>
            
                    <td>
                        %<?php echo $cfi['Vats']['rate']; ?>
                    </td>
                    
                    <td data-value="<?php echo $cfi["amount"]; ?>">
                        <?php echo $cfi["Currencies"]["code"]; ?> 
                        <?php echo $cfi["amount"]; ?>
                    </td>
                    
                    <td>
                        <?php echo $cfi['invoice_To']; ?>
                    </td>
                    
                    <td>
                        <label class="w100">
                            <input 
                                class="tbi inline" 
                                type="checkbox" 
                                name="<?php echo $cfi['id']; ?>[toBeInvoiced]" 
                                value="dni" 
                            /> Don't Invoice
                        </label>
                    </td>
                    
                    <td>
                        <input 
                            class="w75" 
                            name="<?php echo $cfi['id']; ?>[invoice_No]"
                            type="text" 
                        />
                    </td>
                    
                    <td>
                        <input 
                            class="w75 datepick" 
                            name="<?php echo $cfi['id']; ?>[invoice_Date]" 
                            type="text" 
                        />
                    </td>
                
                </tr>
  
            <?php endforeach; ?>
        
        </tbody>
    </table>
    
    <div class="form-actions">

        <input class="btn btn-success" type="submit" name="process" value="Process" />
        
    </div>

</form>


<?php else: ?>

<p>No results fount. Please change your filter settings and try again.</p>

<?php endif; ?>


<script type="text/javascript">
    $(".tbi").change(function()
    {
        if ($(this).attr('checked'))
        {
            $(this).parent().parent().next().children().attr('disabled', true);
            $(this).parent().parent().next().next().children().attr('disabled', true);
        }
        else
        {
            $(this).parent().parent().next().children().attr('disabled', false);
            $(this).parent().parent().next().next().children().attr('disabled', false);
        }
    });
</script>

