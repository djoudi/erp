<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <?php include_stylesheets() ?>
    <?php include_javascripts() ?>
  </head>
  <body>
    
    <?php 
      //active mod detection
      $moduleName = $sf_context->getModuleName();
      $actionName = $sf_context->getActionName();
      $mods_costform = array("costFormProcess", "costFormUser", "costFormReport", "costFormManage");
      $mods_administration = array("currencyManagement", "customerManagement", "employeeManagement", "projectManagement", "vatManagement");
      $mods_workinghours = array();
      
      if (in_array($moduleName, $mods_costform) or $actionName=="costforms") $mod = "costForm";
      elseif (in_array($moduleName, $mods_administration) or $actionName=="administration") $mod = "administration";
      elseif (in_array($moduleName, $mods_workinghours) or $actionName=="workinghours") $mod = "workinghours";
      else $mod = "homepage";
      
      //permission detection
      $permlist_cost = array("Cost Forms", "Cost Form Invoicing", "Cost Form Reports", "Cost Form Management");
      $permlist_admin = array("Currency Management", "Customer Management", "Employee Management", "Project Management", "VAT Management");
      $myPermList = $sf_user->getGuardUser()->getPermissionNames();
    ?>
    
    <div class="container" id="LayoutContainer">
      <?php include_partial ("global/layout_header"); ?>
      <?php include_partial ("global/layout_topmenu"); ?>
      
      
      <div class="row" style="margin-top: 10px;">
      
        <div class="span2" style="width: 160px !important;">
          <?php include_partial("homepage/".$mod); ?>
        </div>
        
        <div class="span11" id="LayoutMainContent">
        
          <?php if (has_slot('title')): ?>
            <div id="LayoutTitle" class="alert alert-info">
              <?php echo get_slot('title') ?>
            </div>
          <?php endif;?>
          
          <?php include_partial ("global/layout_flashes"); ?>
          
          
          <?php echo $sf_content ?>
          
        </div>
        
      </div>
      
    </div>
  
  </body>
</html>
