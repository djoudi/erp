<?php slot ('title', "Office entrance reports"); ?>

<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>


<script>
	$(function() {
		$( "#wh_reports_entrance_selectdate" ).datepicker();
        $( "#wh_reports_entrance_selectdate" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	});
</script>


<form method="get">
    <p>
        Please select a day to list the records:
        <input type="text" name="date" id="wh_reports_entrance_selectdate">
        <input class="btn" type="submit" value="Get Records" />
    </p>
</form>


<?php 
    if ($date):
        include_partial ('dailyreport', array(
            'date'=>$date, 
            'users'=>$users,
            'leaveStatus'=>$leaveStatus
        ));
    endif;
?>
