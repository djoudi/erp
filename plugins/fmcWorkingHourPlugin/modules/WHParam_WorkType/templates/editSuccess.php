<?php include_partial('fmcCore/recordForm', array(
    "form" => $form, 
    "title" => "Edit Work Type : ".$object['name'], 
    "activeClass" => "#topmenu_workinghours", 
    "back_url" => url_for("@whparam_worktype_list")
)); ?>
