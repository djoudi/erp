<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<div class="row">
    
    <div class="span3" style="padding: 0 20px 0 0;">
    
        <?php include_partial ('datepicker', array('date'=>$date)); ?>
    
    </div>    
    
    <div class="span8" style="padding-top: 20px">
        
        <?php
        if ($status=="empty") {
            include_partial ('day_empty', array(
                'date' => $date,
                'form' => $form,
                'leaveTypes' => $leaveTypes
            ));
        } elseif ($status=="workday") {
            include_partial ('day_workday', array(
                'date'=>$date, 
                'dayIOrecords'=>$dayIOrecords, 
                'dayWorkRecords'=>$dayWorkRecords, 
                'workForm'=>$workForm, 
                'entranceForm'=>$entranceForm,
                'exitForm'=>$exitForm
            ));
        }
        ?>
        
    </div><!-- .span8 -->
    
</div><!-- .row -->
