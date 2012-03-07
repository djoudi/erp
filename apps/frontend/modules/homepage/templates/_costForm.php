<?php
  $module = $sf_context->getModuleName();
  $action = $sf_context->getActionName();
?>

<div class="well" style="padding: 8px 0;">
  <ul class="nav nav-list">

      <li class="nav-header">My Costs</li>
      
      <?php if ($sf_user->hasCredential('@costFormUser_list')): ?>
        <li>asdadadas</li>
      <?php endif; ?>
      
      <li <?php if($module=="costFormUser" and $action=="list"): ?> class="active" <?php endif; ?>>
        <?php echo link_to ('List my costs', '@costFormUser_list'); ?>
      </li>
      
      <li <?php if($module=="costFormUser" and $action=="new"): ?> class="active" <?php endif; ?>>
        <?php echo link_to ('New cost form', '@costFormUser_new'); ?>
      </li>

    <?php if ( $sf_user->getGuardUser()->hasPermission("Cost Form Invoicing") ): ?>
      <li class="nav-header">Employee Costs</li>
      <li <?php if($module=="costFormProcess" and $action=="filter"): ?> class="active" <?php endif; ?>>
        <?php echo link_to ('Start invoicing', '@costFormProcess_filter'); ?>
      </li>
      <li <?php if($module=="costFormProcess" and $action=="report"): ?> class="active" <?php endif; ?>>
        <?php echo link_to ('My last invoicing', '@costFormProcess_report'); ?>
      </li>
    <?php endif; ?>
    
    <?php if ( $sf_user->getGuardUser()->hasPermission("Cost Form Reports") ): ?>
      <li class="nav-header">Cost Reports</li>
      <li <?php if($module=="costFormReport" and $action=="index"): ?> class="active" <?php endif; ?>>
        <?php echo link_to ('Cost Reports', '@costFormReport_index'); ?>
      </li>
    <?php endif; ?>
    
  </ul>
</div>
