<?php if (!isset($date)) $date = date("Y-m-d"); ?>

<div class="span3" style="padding: 0 30px 0 0;">
    
    <h5><?php echo Fmc_Wh_Day::getGoodDate ($date); ?></h5>
    
    <?php if (!isset($date)) $date = date("Y-m-d"); ?>
    
    <input 
        id="datepick_whdb_url" 
        type="hidden" 
        defaultdate="<?php echo $date; ?>"
        value="<?php echo url_for('@whuser_day?date='); ?>" 
    />

    <div id="datepick_whdb"></div>

</div>
