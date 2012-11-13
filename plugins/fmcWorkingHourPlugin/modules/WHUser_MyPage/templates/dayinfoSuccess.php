<?php slot('title', 'Edit Work Day' ); ?>

<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>

<div class="row" >
    
    <?php include_partial ('datepicker', array('date'=>$date)); ?>
        
    <div class="span8" style="padding-top: 40px">
    
        <?php include_partial ('dayinfo', array(
            'date'=>$date, 
            'dayIOrecords'=>$dayIOrecords, 
            'dayWorkRecords'=>$dayWorkRecords, 
            'dayDeleteUrl'=>$dayDeleteUrl, 
            'workForm'=>$workForm, 
            'ioTypeCurrent'=>$ioTypeCurrent,
            'ioForm'=>$ioForm 
        )); ?>
    
    </div>
</div>
