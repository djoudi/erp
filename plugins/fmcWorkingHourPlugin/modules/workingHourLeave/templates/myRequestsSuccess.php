<?php slot('title', 'My Leave Requests' ); ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<div class="row">

    <div class="span3">
        <h5><?php echo whDayInfo::getGoodDate ($date); ?></h5>
        <?php include_partial ('workingHourDay/datepicker', array('date'=>$date)); ?>
    </div>
    
    <div class="span9" style="padding-top: 20px">
        
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#all" data-toggle="tab">
                    All Requests
                </a>
            </li>
            <li class="">
                <a href="#accepted" data-toggle="tab">
                    Accepted Requests
                </a>
            </li>
        </ul>
        
        <div class="tab-content">
            
            <div class="tab-pane active in" id="all">
                
                <?php include_partial ('leaveRequestsInfo', array('leaveRequests'=>$allRequests)); ?>
                
            </div>
            
            <div class="tab-pane" id="accepted">
                
                <?php include_partial ('leaveRequestsInfo', array('leaveRequests'=>$acceptedRequests)); ?>
                                                
            </div>
        
        </div>
        
    </div><!-- .span9 -->

</div><!-- .row -->
