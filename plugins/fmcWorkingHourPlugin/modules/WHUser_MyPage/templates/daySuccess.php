<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<div class="row">
    
    <div class="span3" style="padding: 0 0px 0 0;">
    
        <?php include_partial ('datepicker', array('date'=>$date)); ?>
        
        <?php if ($status == 'workday'): ?>
            
            <?php include_partial ('day_workday_options', array('day'=>$day)); ?>
            
        <?php endif; ?>
        
    </div>
    
    <div class="span9" style="padding-top: 20px">
        
        <?php
        if ($status=="empty")
        {
            include_partial ('day_empty', array(
                'date' => $date,
                'form' => $form,
            ));
        }
        elseif ($status=="workday" && $day['status']!="Draft")
        {
            include_partial ('itemlist', array(
                'day'=>$day
            ));
        }
        elseif ($status=="workday")
        {
            include_partial ('day_workday', array(
                'day' => $day, 
                'workForm' => $workForm, 
                'entranceForm' => $entranceForm,
                'exitForm' => $exitForm,
                'dayForm' => $dayForm
            ));
        }
        ?>
        
    </div><!-- .span8 -->
    
</div><!-- .row -->
