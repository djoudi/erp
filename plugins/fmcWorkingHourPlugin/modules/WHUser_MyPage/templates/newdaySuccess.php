<?php slot('title', Fmc_Wh_Day::getGoodDate ($date) ); ?>


<div class="row">
    
    <div class="span3" style="padding: 5px 20px 0 0;">
        <p>Select a date above to go to a day.</p>
        <?php include_partial ('datepicker', array('date'=>$date)); ?>
    </div>
        
    <div class="span8">
        
        <h4>Create new day</h4>
        
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
                
                <p>To create a <strong>Leave Request</strong>, please select desired leave type below.</p>
                
                <?php foreach ($leaveTypes as $type): ?>
                    <p class="text-info">
                        
                        <?php
                            $used = Fmc_Wh_Day::getMyLeaveUsage($type['id']);
                            $available = Fmc_Wh_Day::getMyLeaveLimit($type['id']);
                            $isDisabled = $available > $used ? "btn-success" : "disabled";
                            $url = url_for('@whuser_newleaverequest?date='.$date.'&type='.$type['id']);
                            $href = $isDisabled ? "#" : $url;
                        ?>
                        
                        <a href="<?php echo $url; ?>" class="btn <?php echo $isDisabled; ?>">
                            <?php echo $type; ?>
                        </a>    
                        
                        ( <?php echo $used; ?> of 
                        <?php echo $available; ?> used. )
                    </p>
                <?php endforeach; ?>
                                
            </div><!-- #leave -->
            
        </div><!-- .tab-content -->
    
    </div><!-- .span8 -->
    
</div><!-- .row -->
