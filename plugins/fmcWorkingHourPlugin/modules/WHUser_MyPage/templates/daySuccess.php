<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<div class="row">
    
    <div class="span3" style="padding: 0 0px 0 0;">
        
        <h5><?php echo Fmc_Wh_Day::getGoodDate ($date); ?></h5>
        
        <?php include_partial ('datepicker', array('date'=>$date)); ?>
        
        <?php if (isset($day)): ?>
        
            <hr />
            
            <?php include_partial ('day_info_general', array('day'=>$day)); ?>
            
            <?php if ($day['status']=="Draft"): ?>
                <?php include_partial ('day_draft_options', array('day'=>$day)); ?>
            <?php endif; ?>
            
        <?php endif; ?>
        
    </div>
    
    <div class="span9" style="padding-top: 20px">
        
        <?php
        if ($status=="empty")
        {
            include_component ('WHUser_MyPage', 'newDay', array(
                'date'=>$date, 
                'form'=>$form, 
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
