<?php include_partial('fmcCore/recordForm', array(
    "form" => $form, 
    "title" => "Project: ".$item, 
    "activeClass" => "#topmenu_settings", 
    "back_url" => url_for("@projectManagement")
)); ?>
