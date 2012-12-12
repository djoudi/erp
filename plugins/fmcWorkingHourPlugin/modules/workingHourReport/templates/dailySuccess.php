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
                            <?php $type = $item['WorkingHourDay'][0]['leave_id'] ? "Leave" : "Work"; ?>
                            <?php echo $type; ?>
                        </td>
                        <td>
                            <?php if ($type == "Leave"): ?>
                            
                                <?php echo $item['WorkingHourDay'][0]['LeaveRequest']['LeaveType']['name']; ?>
                                
                            <?php else: ?>
                            
                                <?php $records = $item['WorkingHourDay'][0]['WorkingHourRecords']; ?>
                                
                                <?php echo whDayInfo::getDayIORegular ($records); ?>
                                
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        
        <div class="form-actions">
            
            <div class="pull-right">
                
                <?php $url = url_for('workingHourReport_dailyExcel',array('date'=>$date)); ?>
                
                <a class="btn btn-info" href="<?php echo $url; ?>">
                    Export to Excel
                </a>
                
            </div>
        
        </div>
        
        
    </div><!-- .span9 -->

</div><!-- .row -->
