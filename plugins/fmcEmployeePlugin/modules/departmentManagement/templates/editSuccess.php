<?php include_partial('fmcCore/recordForm', array(
    "form" => $form, 
    "title" => "Department: ".$item, 
    "activeClass" => "#topmenu_settings", 
    "back_url" => url_for("@departmentManagement_list")
)); ?>
