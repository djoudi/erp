
<div id="LayoutHeader">
  <div class="pull-left">
    <a href="<?php echo url_for("@homepage"); ?>"><img src="/images/logo.png" id="LayoutLogo"/></a>
  </div>
  <div class="pull-right" id="LayoutUserinfo">
    <ul id="LayoutUsermenu">
      <li>
        <i class="icon-user"></i>
        <?php echo $sf_user->getGuardUser()->__toString(); ?>
      </li>
      <li>
        <i class="icon-home"></i>
        <a href="<?php echo url_for("@homepage"); ?>">Homepage</a>
      </li>
      <li class="noborder">
        <i class="icon-off"></i>
        <a href="<?php echo url_for("@sf_guard_signout"); ?>">Logout</a>
      </li>
    </ul>
  </div>
</div>

<div class="clear"></div>
