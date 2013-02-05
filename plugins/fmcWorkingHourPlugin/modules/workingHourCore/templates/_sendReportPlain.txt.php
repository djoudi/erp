Hello <?php echo $employee['first_name']." ".$employee['last_name']; ?>.

You are receiving this e-mail because your account is configured to receive e-mail notifications from FMC Data System.

Below you can find your this week's WHDB status report.

<?php if (count($daysEmpty)): ?>
You haven't entered any records for these days:
--------------------
<?php foreach ($daysEmpty as $day): ?>
<?php echo $day."\n"; ?>
<?php endforeach; ?>
<?php endif; ?>

<?php if (count($daysIncomplete)): ?>
Your incomplete days:
--------------------
<?php foreach ($daysIncomplete as $day): ?>
<?php echo $day."\n"; ?>
<?php endforeach; ?>
<?php endif; ?>

<?php if (count($draftLeaves)): ?>
Your unsent leave requests:
--------------------
<?php foreach ($draftLeaves as $leave): ?>
<?php echo $leave->getLeaveType()." - ".$leave['start_Date']." to ".$leave['end_Date']."\n"; ?>
<?php endforeach; ?>
<?php endif; ?>

<?php if (count($pendingLeaves)): ?>
Your pending leave requests:
--------------------
<?php foreach ($pendingLeaves as $leave): ?>
<?php echo $leave->getLeaveType()." - ".$leave['start_Date']." to ".$leave['end_Date']."\n"; ?>
<?php endforeach; ?>
<?php endif; ?>

<?php if (count($daysEmpty) + count($daysIncomplete) + count($draftLeaves) + count($pendingLeaves) == 0): ?>
--------------------
Congratulations! You have filled all your records! You are the best!
<?php endif; ?>
