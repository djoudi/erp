<?php slot('title', 'My Leave Requests' ); ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<div class="row">

    <div class="span3">
        <h5><?php echo whDayInfo::getGoodDate ($date); ?></h5>
        <?php include_partial ('workingHourDay/datepicker', array('date'=>$date)); ?>
    </div>
    
    <div class="span9" style="padding-top: 20px">
        
        <?php if (!count($leaveRequests)): ?>
        
            <p>No requests found.</p>
        
        <?php else: ?>
        
            <table class="tablesorter3a table table-bordered table-condensed table-hover">
                <thead>
                    <th>Status</th>
                    <th>Type</th>
                    <th>From</th>
                    <th>To</th>
                    <th>Comment</th>
                    <th>Report Date</th>
                    <th>Report Number</th>
                    <th></th>
                </thead>
                
                <tbody>
                    <?php foreach ($leaveRequests as $request): ?>
                        <tr>
                            <td>
                                <?php echo $request['status']; ?>
                            </td>
                            <td>
                                <?php echo $request->getLeaveType(); ?>
                            </td>
                            <td>
                                <?php echo $request['start_Date']; ?>
                            </td>
                            <td>
                                <?php echo $request['end_Date']; ?>
                            </td>
                            <td>
                                <?php echo $request['comment']; ?>
                            </td>
                            
                            <?php if ($request['LeaveType']['has_Report']): ?>
                            
                                <td>
                                    <?php echo $request['report_Date']; ?>
                                </td>
                                <td>
                                    <?php echo $request['report_Number']; ?>
                                </td>
                                
                            <?php else: ?>
                                
                                <td colspan="2"></td>
                                
                            <?php endif; ?>
                            
                            <td>
                                <?php $url = url_for ('workingHourLeave_info',array('leave_id'=>$request['id'])); ?>
                                <a href="<?php echo $url; ?>">View</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
        
            </table>
        
        <?php endif; ?>
        
    </div><!-- .span9 -->

</div><!-- .row -->
