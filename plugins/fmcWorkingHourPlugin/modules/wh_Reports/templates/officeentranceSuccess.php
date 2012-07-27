<?php slot ('title', "Office entrance reports"); ?>


<form method="get">
    <p>
        Please select a day to list the records:
        <input type="text" name="date" id="wh_reports_entrance_selectdate">
        <input class="btn" type="submit" value="Get Records" />
    </p>
</form>


<script>
	$(function() {
		$( "#wh_reports_entrance_selectdate" ).datepicker();
        $( "#wh_reports_entrance_selectdate" ).datepicker( "option", "dateFormat", "dd-mm-yy" );
	});
</script>
