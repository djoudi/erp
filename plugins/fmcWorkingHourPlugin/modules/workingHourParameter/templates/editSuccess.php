<?php include_partial('fmcCore/recordForm', array(
    "form" => $form, 
    "title" => "Edit Parameter: ".$object['param'], 
    "activeClass" => "#topmenu_workinghours", 
    "back_url" => url_for("@workingHourParameter_list")
)); ?>
