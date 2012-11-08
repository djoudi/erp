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
                
                <p>To create a <strong>Leave Request</strong>, please select desired leave type below.</p>
                
                <?php foreach ($leaveTypes as $type): ?>
                    <p class="text-info">
                        
                        <?php
                            $used = Fmc_Wh_Day::getMyLeaveUsage($type['id']);
                            $available = Fmc_Wh_Day::getMyLeaveLimit($type['id']);
                            $isDisabled = $available > $used ? "btn-success" : "disabled";
                            $url = url_for('@whuser_newleaverequest?date='.$date.'&type='.$type['id']);
                            $href = $available > $used ? $url : "#";
                        ?>
                        
                        <a href="<?php echo $href; ?>" class="btn <?php echo $isDisabled; ?>">
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
