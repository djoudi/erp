<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?php echo $subject; ?></title>
          <style type="text/css">
            table, th, td { border: 1px solid #ccc; border-spacing: 0; padding: 0 }
            
        </style>
    </head>
    <body>
        <p>
            Hello <?php echo $employee['first_name']." ".$employee['last_name']; ?>.
        </p>
        <p>
            You are receiving this e-mail because your account is configured to receive e-mail notifications from FMC Data System.
        </p>
        <p>
            Below you can find your this week's WHDB status report.
        </p>
        
        
        <?php if (count($daysEmpty)): ?>
        
            <strong>You haven't entered any records for these days:</strong>
            
            <ul>
                <?php foreach ($daysEmpty as $day): ?>
                    <li>
                        <a href="<?php echo url_for('@workingHourDay_date?date='.$day, true); ?>">
                            <?php echo $day; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
            
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
