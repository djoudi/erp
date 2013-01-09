<?php slot ('title', "Approve Working Hours") ?>


<?php slot ('activeClass', "#topmenu_workinghours"); ?>


<?php if (isset($filter)): ?>
    <?php include_partial ('fmcCore/filterForm', array(
        'filter'=>$filter, 
        'filtered'=>$filtered, 
        'count'=>count($items),
        'limit'=>$resultLimit
    )); ?>
<?php endif; ?>



<?php if (count($items)): ?>

<h4>List of Pending Day Requests</h4>

<table class="tablesorter2d table table-hover table-bordered table-condensed">
    <thead>
        <tr>
            <th>Employee</th>
            <th>Date</th>
            <th>Multiplier</th>
            <th>Entrance</th>
            <th>Exit</th>
            <th>Total Hours</th>
            <th>Actions</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php foreach ($items as $item): ?>
            <?php $url = url_for('workingHourApproveDay_details',array('id'=>$item['id'])); ?>
        
            <tr>
                <td>
                    <?php echo $item['Employee']['first_name']." ".$item['Employee']['last_name']; ?> 
                </td>
                <td>
                    <a href="<?php echo $url; ?>">
                        <?php echo whDayInfo::getGoodDate($item['date']); ?>
                    </a>
                </td>
                <td>
                    <?php echo $item['multiplier']; ?>
                </td>
                
                <td>
                    <?php echo $start = $item['WorkingHourRecords'][0]['start_Time']; ?>
                </td>
                <td>
                    <?php echo $end = $item['WorkingHourRecords'][count($item['WorkingHourRecords'])-1]['start_Time']; ?>
                </td>
                <td>
                    <?php echo Fmc_Core_Time::getTimeDifEasy ($end, $start); ?>
                </td>
                <td>
                    <a href="<?php echo $url; ?>">
                        Show
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        
    </tbody>
</table>

<?php endif; ?>
