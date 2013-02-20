<?php slot('title', 'Create new day'); ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<div class="row">

    <div class="span3">
        <h5><?php echo whDayInfo::getGoodDate ($date); ?></h5>
        <?php include_partial ('datepicker', array('date'=>$date)); ?>
    </div>
    
    <div class="span9" style="padding-top: 20px">
        
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#normal" data-toggle="tab">
                    New Work Day
                </a>
            </li>
            <li class="">
                <a href="#leave" data-toggle="tab">
                    New Leave
                </a>
            </li>
        </ul>
        
        
        <div class="tab-content">
            
            <div class="tab-pane active in" id="normal">
                
                <p>To start a new day, please enter your <strong>office entrance</strong> date.</p>
                
                <form method="post">
                    <table class="table table-bordered table-hover table-condensed">
                        <?php echo $form; ?>
                    </table>
                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" value="Continue" />
                    </div>
                </form>
                
            </div>
            
            <div class="tab-pane" id="leave">
                
                <?php include_component ('workingHourLeave', 'newRequest', array('date'=>$date)); ?>
                                                
            </div><!-- #leave -->
            
        </div><!-- .tab-content -->
    
    
    </div><!-- .span9 -->

</div><!-- .row -->
