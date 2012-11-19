<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<div class="row">
    
    <?php include_partial ('datepicker'); ?>
        
    <div class="span8" style="padding-top: 40px">
        
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
