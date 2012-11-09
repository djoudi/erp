<?php slot('title', 'Edit Work Day' ); ?>

<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>

<!--
en üstte sol ve sağa günler gidecek, ortada da tarih yazacak ve takvim çıkacak bir yerdwe? (rollon vs gibi)
-->

<div class="row" >
    
    <?php include_partial ('datepicker', array('date'=>$date)); ?>
        
    <div class="span8" style="padding-top: 40px">
    
        <?php include_partial ('dayinfo', array(
            'dayIOrecords'=>$dayIOrecords, 
            'dayWorkRecords'=>$dayWorkRecords,
            'dayDeleteUrl'=>$dayDeleteUrl
        )); ?>
    
    </div>
</div>



<!--
<p class="pull-left">Note: To change office entrance hour, you have to delete this day.</p>

<a class="btn btn-danger btn-small pull-right" onclick="
      if (confirm('If you continue, all records for today will be DELETED. Are you sure?'))
        parent.location='   PHP ECHO CANCELURL    '
">
    <i class="icon-remove icon-white"></i>
    Delete Day
</a>

<div class="clearfix"></div>

<hr style="margin: 0px 0px 10px 0px" />
-->







