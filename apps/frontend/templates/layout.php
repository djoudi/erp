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
      
      if (in_array($moduleName, $mods_costform) or $actionName=="costforms") $mod = "costForm";
      elseif (in_array($moduleName, $mods_administration) or $actionName=="administration") $mod = "administration";
      else $mod = "homepage";
      
      //permission detection
      $permlist_cost = array("Cost Forms", "Cost Form Invoicing", "Cost Form Reports", "Cost Form Management");
      $permlist_admin = array("Currency Management", "Customer Management", "Employee Management", "Project Management", "VAT Management");
      $myPermList = $sf_user->getGuardUser()->getPermissionNames();
    ?>
    
    <div class="container span18" id="LayoutContainer">
    
      <div id="LayoutHeader">
        <div class="pull-left">
          <a href="<?php echo url_for("@homepage"); ?>"><img src="/images/logo.png" id="LayoutLogo"/></a>
        </div>
        <div class="pull-right" id="LayoutUserinfo">
          <ul id="LayoutUsermenu">
            <li>Welcome, <?php echo $sf_user->getGuardUser()->__toString(); ?></li>
            <li><a href="<?php echo url_for("@homepage"); ?>">Homepage</a></li>
            <li class="noborder"><a href="<?php echo url_for("@sf_guard_signout"); ?>">Logout</a></li>
          </ul>
        </div>
      </div>
      
      <div class="clear"></div>
      
      <?php include_partial ("global/layout_topmenu"); ?>
      
      <div class="clear"></div>
      
      <br /><br />
      
      <div class="row">
      
        <div class="span3">
          <?php include_partial("homepage/".$mod); ?>
        </div>
        
        <div class="span15" id="LayoutMainContent">
        
          <?php if (has_slot('title')): ?>
            <div id="LayoutTitle">
              <h1><?php echo get_slot('title') ?></h1>
            </div>
          <?php endif;?>
          
          <br />
          
          <?php if ($sf_user->hasFlash('success')): ?>
            <div class="alert-message success">
              <a class="close" onclick="$(this).parent().hide()">×</a>
              <p><?php echo $sf_user->getFlash('success') ?></p>
            </div>
          <?php endif ?>
          
          <?php if ($sf_user->hasFlash('notice')): ?>
            <div class="alert-message warning">
              <a class="close" onclick="$(this).parent().hide()">×</a>
              <p><?php echo $sf_user->getFlash('notice') ?></p>
            </div>
          <?php endif ?>
          
          <?php if ($sf_user->hasFlash('error')): ?>
            <div class="alert-message error">
              <a class="close" onclick="$(this).parent().hide()">×</a>
              <p><?php echo $sf_user->getFlash('error') ?></p>
            </div>
          <?php endif ?>
          
          <br />
          
          <?php echo $sf_content ?>
          
        </div>
        
      </div>
      
    </div>
  
  </body>
</html>
