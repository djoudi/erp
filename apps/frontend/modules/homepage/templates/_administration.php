<?php
  $module = $sf_context->getModuleName();
  $action = $sf_context->getActionName();
?>

<div class="well" style="padding: 8px 0;">
  <ul class="nav nav-list">

    <?php if ( $sf_user->getGuardUser()->hasPermission("Customer Management") ): ?>
      <li class="nav-header">Customers</li>
      <li <?php if($module=="customerManagement" and $action=="index"): ?> class="active" <?php endif; ?>>
        <?php echo link_to ('Customer list', '@customerManagement'); ?>
      </li>
      <li <?php if($module=="customerManagement" and $action=="new"): ?> class="active" <?php endif; ?>>
        <?php echo link_to ('New customer', '@customerManagement_new'); ?>
      </li>
    <?php endif; ?>
    
    <?php if ( $sf_user->getGuardUser()->hasPermission("Project Management") ): ?>
      <li class="nav-header">Projects</li>
      <li <?php if($module=="projectManagement" and $action=="index"): ?> class="active" <?php endif; ?>>
        <?php echo link_to ('Project list', '@projectManagement'); ?>
      </li>
      <li <?php if($module=="projectManagement" and $action=="new"): ?> class="active" <?php endif; ?>>
        <?php echo link_to ('New project', '@projectManagement_new'); ?>
      </li>
    <?php endif; ?>
        
    <?php if ( $sf_user->getGuardUser()->hasPermission("Employee Management") ): ?>
      <li class="nav-header">Employees</li>
      <li <?php if($module=="employeeManagement" and $action=="index"): ?> class="active" <?php endif; ?>>
        <?php echo link_to ('Employee list', '@employeeManagement'); ?>
      </li>
      <li <?php if($module=="employeeManagement" and $action=="new"): ?> class="active" <?php endif; ?>>
        <?php echo link_to ('New employee', '@employeeManagement_new'); ?>
      </li>
    <?php endif; ?>
    
    <?php if (
      $sf_user->getGuardUser()->hasPermission("VAT Management") or
      $sf_user->getGuardUser()->hasPermission("Currency Management")
    ): ?>
      <li class="nav-header">Program Settings</li>
      <?php if ( $sf_user->getGuardUser()->hasPermission("VAT Management") ): ?>
        <li <?php if($module=="vatManagement" and $action=="index"): ?> class="active" <?php endif; ?>>
          <?php echo link_to ('VAT', '@vatManagement_index'); ?>
        </li>
      <?php endif; ?>
      <?php if ( $sf_user->getGuardUser()->hasPermission("Currency Management") ): ?>
        <li <?php if($module=="currencyManagement" and $action=="index"): ?> class="active" <?php endif; ?>>
          <?php echo link_to ('Currency', '@currencyManagement_index'); ?>
        </li>
      <?php endif; ?>
    <?php endif; ?>
    
  </ul>
</div>
