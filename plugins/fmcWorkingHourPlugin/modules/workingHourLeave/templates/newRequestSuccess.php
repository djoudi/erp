<?php slot('title', 'New '.$leaveType ); ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<div class="row">

    <div class="span3">
        <h5><?php echo whDayInfo::getGoodDate ($date); ?></h5>
        <?php include_partial ('workingHourDay/datepicker', array('date'=>$date)); ?>
    </div>
    
    <div class="span9" style="padding-top: 20px">
        
        
        <form class="form-horizontal" method="post">
            
            <table class="table table-condensed table-bordered table-hover">
                <?php echo $form; ?>
            </table>
            
            <div class="form-actions">
                <a class="btn" href="<?php #echo url_for('@whuser_day?date='.$date); ?>">Go Back</a>
                <input class="btn btn-primary" type="submit" value="Create Request" />
            </div>
            
        </form>
        
    </div><!-- .span9 -->
    
</div><!-- .row -->
