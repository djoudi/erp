<?php if (!isset($date)) $date = date("Y-m-d"); ?>
  
<h5><?php echo Fmc_Wh_Day::getGoodDate ($date); ?></h5>

<input 
    id="datepick_whdb_url" 
    type="hidden" 
    defaultdate="<?php echo $date; ?>"
    value="<?php echo url_for('@wh_my_day?date='); ?>" 
/>

<div id="datepick_whdb"></div>
