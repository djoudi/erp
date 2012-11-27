<?php slot ('activeClass', "#topmenu_workinghours"); ?>


<div class="row">


    <div class="span3">
        
        
        <h5><?php echo Fmc_Wh_Day::getGoodDate ($date); ?></h5>
        
        
        <?php include_partial ('datepicker', array('date'=>$date)); ?>
        
        
        <hr />
        
        
        <table class="table table-bordered table-condensed table-hover">
            <tr>
                <th>Day Status</th>
                <td><?php echo $day['status']; ?></td>
            </tr>
            <tr>
                <th>Office Entrance</th>
                <td><?php echo $day['office_Entrance']; ?></td>
            </tr>
            <tr>
                <th>Office Exit</th>
                <td><?php echo $day['office_Exit']; ?></td>
            </tr>
            <tr>
                <th>Day Multiplier</th>
                <td><?php echo $day['multiplier']; ?></td>
            </tr>
        </table>
        
        
        <?php if ($day['status']=="Draft"): ?>        
            <ul class="unstyled">
                <p>
                    <?php include_partial ('fmcCore/confirmButton', array(
                        'class' => 'btn btn-success btn-small',
                        'url' => url_for('wh_my_day_sendapprove',array('date'=>$day['date'])),
                        'label' => 'Send for Approve',
                        'text' => 'Are you sure you want to send this day for approval?',
                        "iconClass" => 'icon-ok icon-white'
                    )); ?>
                </p>
                <p>
                    <?php include_partial ('fmcCore/confirmButton', array(
                        'class' => 'btn btn-danger btn-small',
                        'url' => url_for('wh_my_day_deleteday',array('date'=>$day['date'])),
                        'label' => 'Cancel Day',
                        "iconClass" => 'icon-remove icon-white'
                    )); ?>
                </p>
            </ul>
        <?php endif; ?>
        
        
    </div>
    
    
    <div class="span9" style="padding-top: 20px">
        
        <?php include_partial ('dayitems', array('day'=>$day)); ?>
        
        <?php include_partial ('dayforms', array(
            'day' => $day, 
            'workForm' => $workForm, 
            'entranceForm' => $entranceForm,
            'exitForm' => $exitForm,
            'dayForm' => $dayForm
        )); ?>
        
    </div><!-- .span8 -->


</div><!-- .row -->
