<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
    </head>
    <body>
    
        <div class="container">
            
            <a class="pull-left" href="<?php echo url_for("@homepage"); ?>">
                <img src="/images/logo.png" id="LayoutLogo"/>
            </a>
            
            <div class="pull-right" id="layout_top_userinfo">
                <i class="icon-user"></i>
                <strong><?php echo $sf_user->getGuardUser()->__toString(); ?></strong> | 
                <a href="<?php echo url_for("@sf_guard_signout"); ?>">
                    Logout <i class="icon-off"></i>
                </a>
            </div>
            
            <div class="clearfix"></div>
            
            <?php
                $arr = sfConfig::get('app_menus_topmenu');
                $menu = ioMenuItem::createFromArray($arr);
                echo $menu->render();
            ?>
            
            <div class="clearfix"></div>
            
            <?php if (has_slot('title')): ?>
                <div id="layout_title" class="alert alert-info">
                    <?php echo get_slot('title') ?>
                </div>
            <?php endif;?>
            
            <div class="clearfix"></div>
            
            <?php if ($sf_user->hasFlash('success')): ?>
                <div class="alert alert-success fade in">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo $sf_user->getFlash('success') ?>
                </div>
            <?php endif ?>
            <?php if ($sf_user->hasFlash('notice')): ?>
                <div class="alert alert-info fade in">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo $sf_user->getFlash('notice') ?>
                </div>
            <?php endif ?>
            <?php if ($sf_user->hasFlash('error')): ?>
                <div class="alert alert-error  fade in">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <?php echo $sf_user->getFlash('error') ?>
                </div>
            <?php endif ?>
            
            <?php echo $sf_content ?>
            
        </div>
    
    
    <div class="container" id="LayoutContainer">

      
      <div class="row" style="margin-top: 10px;">
      
        <?php /*
        <div class="span2" style="width: 160px !important;">
          <?php include_partial("homepage/".$mod); ?>
        </div>
        */ ?>
        
        <div class="span11" id="LayoutMainContent">
        

          <?php include_partial ("global/layout_flashes"); ?>
          
          
          
          
        </div>
        
      </div>
      
    </div>



        <?php include_javascripts() ?>
    </body>
</html>
