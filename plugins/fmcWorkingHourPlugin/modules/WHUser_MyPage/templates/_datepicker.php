<?php if (!isset($date)) $date = date("Y-m-d"); ?>

<input 
    id="datepick_whdb_url" 
    type="hidden" 
    defaultdate="<?php echo $date; ?>"
    value="<?php echo url_for('@whuser_day?date='); ?>" 
/>

<div id="datepick_whdb"></div>
