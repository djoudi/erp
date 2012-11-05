<?php include_partial('fmcCore/recordForm', array(
    "form" => $form, 
    "title" => "Editing: ".$object['name'], 
    "activeClass" => "#topmenu_workinghours", 
    "back_url" => url_for("@whparam_holiday_list")
)); ?>
