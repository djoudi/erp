<?php
  $arr = sfConfig::get('app_menus_topmenu');
  $menu = ioMenuItem::createFromArray($arr);
  echo $menu->render();
?>

<div class="clear"></div>
