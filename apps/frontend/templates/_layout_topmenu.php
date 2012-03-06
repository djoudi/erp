<?php 
  //active mod detection
  $moduleName = $sf_context->getModuleName();
  $actionName = $sf_context->getActionName();
  $mods_costform = array("costFormProcess", "costFormUser", "costFormReport", "costFormManage");
  $mods_administration = array("currencyManagement", "customerManagement", "employeeManagement", "projectManagement", "vatManagement");
  
  if (in_array($moduleName, $mods_costform) or $actionName=="costforms") $mod = "costForm";
  elseif (in_array($moduleName, $mods_administration) or $actionName=="administration") $mod = "administration";
  else $mod = "homepage";
  
  //permission detection
  $permlist_cost = array("Cost Forms", "Cost Form Invoicing", "Cost Form Reports", "Cost Form Management");
  $permlist_admin = array("Currency Management", "Customer Management", "Employee Management", "Project Management", "VAT Management");
  $myPermList = $sf_user->getGuardUser()->getPermissionNames();
?>
    
<ul id="LayoutTopMenu" class="nav nav-tabs">
      
  <li class="<?php if ($mod=="homepage"): ?>active<?php endif;?>">
    <a href="<?php echo url_for("@homepage"); ?>">Home</a>
  </li>
  
  <?php if (array_intersect($myPermList, $permlist_cost)): ?>
    <li class="<?php if ($mod=="costForm"): ?>active<?php endif;?>">
      <a href="<?php echo url_for("@costforms"); ?>">Cost Forms</a>
    </li>
  <?php endif; ?>
  
  <?php if (array_intersect($myPermList, $permlist_admin)): ?>
    <li class="<?php if ($mod=="administration"): ?>active<?php endif;?>">
      <a href="<?php echo url_for("@administration"); ?>">Administration</a>
    </li>
  <?php endif; ?>
  
</ul>

<div class="clear"></div>

<?php echo sfConfig::get('app_testes');
