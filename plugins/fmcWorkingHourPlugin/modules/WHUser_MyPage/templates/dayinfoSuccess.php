<?php slot('title', 'Edit Work Day' ); ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

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
