<?php if ( $sf_user->getGuardUser()->hasPermission("Customer Management") ): ?>
  <h4>Customers</h4>
  <ul>
    <li><a href="<?php echo url_for("@customerManagement"); ?>">Customer list</a></li>
    <li><a href="<?php echo url_for("@customerManagement_new"); ?>">New customer</a></li>
  </ul>
<?php endif; ?>


<?php if ( $sf_user->getGuardUser()->hasPermission("Project Management") ): ?>
  <h4>Projects</h4>
  <ul>
    <li><a href="<?php echo url_for("@projectManagement"); ?>">Project list</a></li>
    <li><a href="<?php echo url_for("@projectManagement_new"); ?>">New project</a></li>
  </ul>
<?php endif; ?>


<?php if ( $sf_user->getGuardUser()->hasPermission("Employee Management") ): ?>
  <h4>Employees</h4>
  <ul>
    <li><a href="<?php echo url_for("@employeeManagement"); ?>">Employee list</a></li>
    <li><a href="<?php echo url_for("@employeeManagement_new"); ?>">New employee</a></li>
  </ul>
<?php endif; ?>


<?php if (
  $sf_user->getGuardUser()->hasPermission("VAT Management") or
  $sf_user->getGuardUser()->hasPermission("Currency Management")
): ?>
  <h4>Program Settings</h4>
  <ul>
    <li><a href="<?php echo url_for("@currencyManagement_index"); ?>">Currency</a></li>  
    <li><a href="<?php echo url_for("@vatManagement_index"); ?>">VAT</a></li>
  </ul>
<?php endif; ?>

