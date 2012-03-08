<div class="well" id="LayoutLeftMenu">
  <?php
    $arr = sfConfig::get('app_menus_leftmenu_costform');
    $menu = ioMenuItem::createFromArray($arr);
    echo $menu->render();
  ?>
</div>
