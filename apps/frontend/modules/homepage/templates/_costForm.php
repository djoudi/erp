
<?php if ( $sf_user->getGuardUser()->hasPermission("Cost Forms") ): ?>
  <h4>My Costs</h4>
  <ul>
    <li><a href="<?php echo url_for("@costFormUser_list"); ?>">List my costs</a></li>
    <li><a href="<?php echo url_for("@costFormUser_new"); ?>">Create new cost form</a></li>
  </ul>
<?php endif; ?>


<?php if ( $sf_user->getGuardUser()->hasPermission("Cost Form Invoicing") ): ?>
  <h4>Employee Costs</h4>
  <ul>
    <li><a href="<?php echo url_for("@costFormProcess_filter"); ?>">Start invoicing</a></li>
    <li><a href="<?php echo url_for("@costFormProcess_report"); ?>">My last invoicing</a></li>
  </ul>
<?php endif; ?>


<?php if ( $sf_user->getGuardUser()->hasPermission("Cost Form Reports") ): ?>
  <h4>Reports</h4>
  <ul>
    <li><a href="<?php echo url_for("@costFormReport_index"); ?>">Cost Reports</a></li>
  </ul>
<?php endif; ?>
