<?php slot ('title', 'My working hours'); ?>

<div class="row">
  
  <div class="span8">
    
    <h4>Today</h4>
    <?php include_partial ('itemlist', array('items'=>$todayItems)); ?>
    <a href="<?php echo url_for('workingHourUser_edit', array('date'=>date('Y-m-d'))); ?>">
      Go to today
    </a>
    
  </div>

  <div class="span2">
    
    select date
    <input id="datepick_whdb_url" type="hidden" value="<?php echo url_for('@workingHourUser_edit?date='); ?>" />
    Date: <div id="datepick_whdb"></div>

  </div>

</div>

<h4>My last items</h4>
<?php include_partial ('itemlist', array('items'=>$lastItems)); ?>
