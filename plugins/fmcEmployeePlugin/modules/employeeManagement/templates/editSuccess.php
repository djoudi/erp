<?php include_partial('fmcCore/recordForm', array(
    "form" => $form, 
    "title" => "Employee: ".$item["name"], 
    "activeClass" => "#topmenu_settings", 
    "back_url" => url_for("@employeeManagement")
)); ?>
