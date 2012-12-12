<?php slot('title', 'Daily Entrance/Exit Report' ); ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<div class="row">

    <div class="span3">
        <h5><?php echo whDayInfo::getGoodDate ($date); ?></h5>
        <?php include_partial ('datepicker_report', array('date'=>$date)); ?>
    </div>
    
    <div class="span9" style="padding-top: 20px">
        
        <p>You can find daily record of the employees <strong>who have entered for today.</strong></p>
        
        <table class="table table-bordered table-condensed table-hover">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Status</th>
                    <th>Day Type</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list as $item): ?>
                    <tr>
                        <td>
                            <?php echo $item['first_name']." ".$item['last_name']; ?>
                        </td>
                        <td>
                            <?php echo $item['WorkingHourDay'][0]['status']; ?>
                        </td>
                        <td>
                            <?php $status = $item['WorkingHourDay'][0]['leave_id'] ? "Leave" : "Work"; ?>
                            <?php echo $status; ?>
                        </td>
                        <td>
                            <?php if ($status == "Leave"): ?>
                                <?php echo $item['WorkingHourDay'][0]['LeaveRequest']['LeaveType']['name']; ?>
                            <?php else: ?>
                            
                                <?php $records = $item['WorkingHourDay'][0]['WorkingHourRecords']; ?>
                                
                                
                                <?php foreach ($records as $index=>$record): ?>
                                    
                                    <?php if ($record['recordType']!="Work"): ?>
                                    
                                        <?php echo substr( $record['start_Time'] , 0 , 5 ); ?>
                                        
                                        <?php if ($record['recordType']=="Entrance") echo " - ";
                                            elseif ( $index < (count($records)-1) ) echo ", "; ?>
                                    
                                    <?php endif; ?>
                                    
                                <?php endforeach; ?>
                        
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
    </div><!-- .span9 -->

</div><!-- .row -->
