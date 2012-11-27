<?php include_partial('fmcCore/recordForm', array(
    "form" => $form, 
    "title" => "Editing: ".$object['name'], 
    "activeClass" => "#topmenu_settings", 
    "back_url" => url_for("holidayManagement_list")
)); ?>
