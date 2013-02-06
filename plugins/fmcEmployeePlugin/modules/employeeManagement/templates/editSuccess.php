<?php include_partial('fmcCore/recordForm', array(
    "form" => $form, 
    "title" => "Employee: ".$item["name"], 
    "activeClass" => "#topmenu_settings", 
    "back_url" => url_for("@employeeManagement"),
    "rightList_title" => "Worktypes of this user's department",
    "rightList_items" => $item->getDepartment()->getWorkTypes()
)); ?>
