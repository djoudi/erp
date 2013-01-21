<?php slot('title', 'Work Day'); ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<div class="row">

    <div class="span3">
        
        <?php if (isset($date) && $date): ?>
        
            <h5><?php echo whDayInfo::getGoodDate ($date); ?></h5>
            
            <?php include_partial ('datepicker', array('date'=>$date)); ?>
            
        <?php endif; ?>
        
        <hr />
        
        <?php if (isset($day) && $day): ?>
            <table class="table table-bordered table-condensed table-hover">
                <tr>
                    <th>Day Status</th>
                    <td><?php echo $day['status']; ?></td>
                </tr>
                <tr>
                    <th>Office Entrance</th>
                    <td>
                        <?php if ($enter = $day->getFirst("Entrance")): ?>
                            <?php echo $enter['start_Time']; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Office Exit</th>
                    <td>
                        <?php if ($exit = $day->getLast("Exit")): ?>
                            <?php echo $exit['start_Time']; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <th>Day Multiplier</th>
                    <td><?php echo $day['multiplier']; ?></td>
                </tr>
                <tr>
                    <th>Daily Breaks</th>
                    <td><?php echo $day['daily_Breaks']; ?> min(s)</td>
                </tr>
                
            </table>
        <?php endif; ?>
        
        <?php if (isset($day) && $day['status']=="Draft"): ?>        
            <ul class="unstyled">
                <p>
                    <?php include_partial ('fmcCore/confirmButton', array(
                        'class' => 'btn btn-success btn-small',
                        'url' => url_for('workingHourDay_approveday',array('date'=>$day['date'])),
                        'label' => 'Send',
                        'text' => 'Are you sure you want to save this day? Warning! You cannot change this send this day again!',
                        "iconClass" => 'icon-ok icon-white'
                    )); ?>
                </p>
                <p>
                    <?php include_partial ('fmcCore/confirmButton', array(
                        'class' => 'btn btn-danger btn-small',
                        'url' => url_for('workingHourDay_deleteday',array('date'=>$day['date'])),
                        'label' => 'Cancel Day',
                        "iconClass" => 'icon-remove icon-white'
                    )); ?>
                </p>
            </ul>
        <?php endif; ?>    
        
    </div>
    
    <div class="span9" style="padding-top: 20px">
        
        <?php if (isset($day) && $day): ?>
            <?php include_partial ('dayitems', array(
                'dayRecords'=>$dayRecords,
                'dayStatus'=>$day['status'],
                'dayDate'=>$day['date']
            )); ?>
        <?php endif; ?>
        
        <div class="clearfix"></div>
        
        <?php if (isset($day) && $day): ?>
            <?php if ($day['status']=="Draft"): ?>
                <?php include_partial ('dayforms', array(
                    'day' => $day, 
                    'workForm' => $workForm, 
                    'entranceForm' => $entranceForm, 
                    'exitForm' => $exitForm, 
                    'dailyBreaksForm' =>$dailyBreaksForm
                )); ?>
            <?php endif; ?>
        <?php endif; ?>
        
    </div><!-- .span9 -->
    
</div><!-- .row -->
