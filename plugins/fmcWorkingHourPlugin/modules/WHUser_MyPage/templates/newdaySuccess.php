<?php slot('title', 'Create new day'); ?>


<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>


<div class="row" >
    
    <?php include_partial ('datepicker', array('date'=>$date)); ?>
        
    <div class="span8" style="padding-top: 40px">
        
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#normal" data-toggle="tab">New Work Day</a></li>
            <li class=""><a href="#leave" data-toggle="tab">New Leave</a></li>
        </ul>
    
        <div class="tab-content">
            
            <div class="tab-pane fade active in" id="normal">
                
                <p>To start a new day, please enter your <strong>office entrance</strong> date.</p>
                
                <form class="form-horizontal" method="post">
                    
                    <table class="table table-bordered table-hover table-condensed">
                        <?php echo $form; ?>
                    </table>
                
                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" value="Continue" />
                    </div>
                
                </form>
                
            </div>
            
            <div class="tab-pane fade" id="leave">
                
                <?php include_partial ('leaveoptions', array(
                    'leaveTypes'=>$leaveTypes,
                    'date'=>$date
                )); ?>
                                                
            </div><!-- #leave -->
            
        </div><!-- .tab-content -->
    
    </div><!-- .span8 -->
    
</div><!-- .row -->
