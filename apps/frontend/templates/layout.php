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







<div class="container" id="Layout_Container">


            
<div class="Layout_Headerbar clearfix">
    <h3 class="pull-left">
        <?php echo get_slot('title', 'FMC') ?>
    </h3>
    <a 
        class="pull-right" 
        id="Layout_Toplogo" 
        href="<?php echo url_for("@homepage"); ?>"
    >
        <img src="/images/logo.png" />
    </a>
</div>



<div class="navbar clearfix" id="topbar">
    <div class="navbar-inner">
        <div class="container">
            <div class="nav-collapse collapse navbar-responsive-collapse">
                <?php
                    $arr = sfConfig::get('app_menus_topmenu');
                    $menu = ioMenuItem::createFromArray($arr);
                    echo $menu->render();
                ?>
                <ul class="nav pull-right">
                    <li class="divider-vertical"></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i>
                            <?php echo $sf_user->getGuardUser()->__toString(); ?> 
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="<?php echo url_for("@sf_guard_signout"); ?>">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li><!-- /dropdown -->
                </ul><!-- /nav -->
            </div><!-- /.nav-collapse -->
        </div><!-- /container -->
    </div><!-- /navbar-inner -->
</div><!-- /navbar -->



<?php if ($sf_user->hasFlash('success')): ?>
    <div class="alert alert-success fade in">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <?php echo $sf_user->getFlash('success') ?>
    </div>
<?php endif ?>
<?php if ($sf_user->hasFlash('notice')): ?>
    <div class="alert fade in">
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


<div id="Layout_MainContent" class="clearfix">
    <?php echo $sf_content ?>
</div>



</div><!-- /container -->



<?php include_javascripts() ?>



<?php if (has_slot('activeClass')): ?>
    <script type="text/javascript">
        $("<?php echo get_slot('activeClass'); ?>").addClass("active");
    </script>
<?php endif; ?>

        
        
    </body>
</html>
