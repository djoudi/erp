<?php slot ('title', 'My working hours'); ?>

<div class="pull-left">

<h4>Today</h4>
<?php include_partial ('itemlist', array('items'=>$todayItems)); ?>
<a href="<?php echo url_for('workingHourUser_editday', array('date'=>date('Y-m-d'))); ?>">
  Go to today
</a>

</div>  

<div class="pull-right">
  <?php include_partial ('dateselector'); ?>
</div>

<div class="clear"></div>

<h4>My last items</h4>
<?php include_partial ('itemlist', array('items'=>$lastItems)); ?>
