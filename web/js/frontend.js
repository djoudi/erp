$(document).ready(function() 
{
  
  // Tablesorter
  $(".tablesorter").tablesorter( {sortList: [[0,0]]} );
  $(".tablesorter1d").tablesorter( {sortList: [[0,1]]} );
  $(".tablesorter2a").tablesorter( {sortList: [[1,0]]} );
  $(".tablesorter3a").tablesorter( {sortList: [[2,0]]} );
  $(".tablesorter4a").tablesorter( {sortList: [[3,0]]} );
  
  
  // Tablesorter pager
  $(".tablesorterpager").tablesorterPager({
    container: $(".tablesorterpagerdiv"), 
    positionFixed: false, 
    size: 15
  });
  
  
  // Bootstrap
  $('.tooltips').tooltip();
  $('.datepick').datepicker({ dateFormat: "yy-mm-dd" });
  
  
  // Timepicker
  var a = "#working_hour_time_started";
  var b = "#working_hour_time_finished";
  $(a).timePicker();
  $(b).timePicker();
  var oldTime = $.timePicker(a).getTime();
  $(a).change(function()
  {
    if ($(b).val())
    {
      var duration = ($.timePicker(b).getTime() - oldTime);
      var time = $.timePicker(a).getTime();
      $.timePicker(b).setTime(new Date(new Date(time.getTime() + duration)));
      oldTime = time;
    }
  });
  $(b).change(function()
  {
    if($.timePicker(a).getTime() > $.timePicker(this).getTime()) {
      $(this).addClass("timepicker-error");
      
    }
    else {
      $(this).removeClass("timepicker-error");
    }
    var x = $.timePicker(a).getTime();
    var y = $.timePicker(b).getTime();
    var z = ( y-x ) / 60000;
    var minute = z % 60;
    var hour = (z-minute) / 60;
    $('#timetotal').html(hour+"h "+minute+"m");
  });
  
  
}
);

