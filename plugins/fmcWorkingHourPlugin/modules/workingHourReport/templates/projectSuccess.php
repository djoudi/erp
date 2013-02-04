<?php slot('title', 'Project Report' ); ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<form method="post">
    <table class="table table-bordered table-condensed table-hover">
        <?php echo $form;?>
    </table>
    
    <input class="btn btn-primary" type="submit" value="Get Results" />
    
</form>

<?php if (!$items): ?>
    
    Please select a filter.
    
<?php else: ?>
    
    <p>
        <?php echo $count = count($items); ?> results found.
    </p>
    
    <?php if ($count): ?>
        
        <a 
            class="btn btn-success pull-right" 
            href="<?php echo url_for("@workingHourReport_project_excel?from={$from}&to={$to}&proj={$proj}"); ?>">
            Export to Excel
        </a>
    
        <table class="tablesorter table table-bordered table-condensed table-hover">
            <thead>
                <tr>
                    <th>Work date</th>
                    <th>Employee</th>
                    <th>Time</th>
                    <th>Work Type</th>
                    <th>Notes</th>
                </tr>
            </thead>
            
            <tbody>
            
                <?php $totalMin = 0; ?>
                
                <?php foreach ($items as $item): ?>
                    
                    <?php $timeDif = Fmc_Core_Time::getTimeDif ($item['end_Time'], $item['start_Time']); ?>
                    
                    <?php $totalMin += $timeDif; ?>
                    
                    <tr>
                        <td>
                            <?php echo $item['Day']['date']; ?>
                        </td>
                        <td>
                            <?php echo $item['Day']['Employee']['first_name']." ".$item['Day']['Employee']['last_name']; ?>
                        </td>
                        <td>
                            <?php echo Fmc_Core_Time::getTimeEasy ($timeDif); ?>
                        </td>
                        <td>
                            <?php echo $item['WorkType']['name']; ?>
                        </td>
                        <td>
                            <?php echo $item['comment']; ?>
                        </td>
                    </tr>
                    
                <?php endforeach; ?>
            
            </tbody>
            
            <tfoot>
                <tr>
                    <td colspan="2">
                        Total
                    </td>
                    <td>
                        <?php echo Fmc_Core_Time::getTimeEasy($totalMin); ?>
                    </td>
                    <td colspan="2">
                        &nbsp;
                    </td>
                </tr>
            </tfoot>
            
        </table>
        
    <?php endif; ?>
    
<?php endif; ?>
