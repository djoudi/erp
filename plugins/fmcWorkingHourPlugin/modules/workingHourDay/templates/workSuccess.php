<?php slot('title', 'Work Day'); ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<div class="row">

    <div class="span3">
        
        <h5><?php echo whDayInfo::getGoodDate ($date); ?></h5>
        
        <?php include_partial ('datepicker', array('date'=>$date)); ?>
        
        <hr />
        
        <table class="table table-bordered table-condensed table-hover">
            <tr>
                <th>Day Status</th>
                <td><?php echo $day['status']; ?></td>
            </tr>
            <tr>
                <th>Office Entrance</th>
                <td>
                    <?php if ($day->getFirst("Entrance")): ?>
                        <?php echo $day->getFirst("Entrance")->getStartTime(); ?>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Office Exit</th>
                <td>
                    <?php if ($day->getFirst("Exit")): ?>
                        <?php echo $day->getFirst("Exit")->getStartTime(); ?>
                    <?php endif; ?>
                </td>
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
                        'url' => url_for('homepage',array('date'=>$day['date'])),
                        'label' => 'Send for Approve',
                        'text' => 'Are you sure you want to send this day for approval?',
                        "iconClass" => 'icon-ok icon-white'
                    )); ?>
                </p>
                <p>
                    <?php include_partial ('fmcCore/confirmButton', array(
                        'class' => 'btn btn-danger btn-small',
                        'url' => url_for('homepage',array('date'=>$day['date'])),
                        'label' => 'Cancel Day',
                        "iconClass" => 'icon-remove icon-white'
                    )); ?>
                </p>
            </ul>
        <?php endif; ?>    
        
    </div>
    
    <div class="span9" style="padding-top: 20px">
        
        <?php include_partial ('dayitems', array('day'=>$day)); ?>
        
        <div class="clearfix"></div>
        
        <?php if ($day['status']=="Draft"): ?>
            <?php include_partial ('dayforms', array(
                'day' => $day, 
                'workForm' => $workForm, 
                #'entranceForm' => $entranceForm,
                #'exitForm' => $exitForm,
            )); ?>
        <?php endif; ?>
        
    </div><!-- .span8 -->
    
</div><!-- .row -->
