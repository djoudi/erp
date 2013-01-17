Hello <?php echo $employee['first_name']." ".$employee['last_name']; ?>.

You are receiving this e-mail because your account is configured to receive e-mail notifications from FMC Data System.

Below you can find your this week's WHDB status report.


<?php if (count($daysEmpty)): ?>

You haven't entered any records for these days:
----------

<?php foreach ($daysEmpty as $day): ?>
<?php echo $day; ?>
<?php endforeach; ?>

<?php endif; ?>
        
        
        <?php if (count($daysIncomplete)): ?>
        
            <strong>Your incomplete days:</strong>
            
            <ul>
                <?php foreach ($daysIncomplete as $day): ?>
                    <li>
                        <a href="<?php echo url_for('@workingHourDay_date?date='.$day, true); ?>">
                            <?php echo $day; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            
        <?php endif; ?>
        
        
        <?php if (count($draftLeaves)): ?>
            <p>
                <strong>Your unsent leave requests:</strong>
            </p>
            <?php include_partial ('workingHourLeave/leaveRequestsInfo', array('leaveRequests'=>$draftLeaves)); ?>
        <?php endif; ?>
        
        
        <?php if (count($pendingLeaves)): ?>
            <p>
                <strong>Your pending leave requests:</strong>
            </p>
            <?php include_partial ('workingHourLeave/leaveRequestsInfo', array('leaveRequests'=>$pendingLeaves)); ?>
        <?php endif; ?>
        
        
        <p>&nbsp;</p>
        
    </body>
</html>
