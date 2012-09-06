$(document).ready(function() 
{
    
    /* Refs #55 - Submenu under Topmenu , ioPlugin with Bootstrap */
    
        $("ul#layout_top_menu > li.dropdown > a").addClass("dropdown-toggle");
        $("ul#layout_top_menu > li.dropdown > a").attr("data-toggle", "dropdown");
        $("ul#layout_top_menu > li.dropdown > ul").addClass("dropdown-menu");
        $("ul#layout_top_menu > li.dropdown > ul").attr("role", "menu");
        
        /* Shows dropdown arrows */
        $("ul#layout_top_menu > li > a").not(":first").append(' <b class="caret"></b>');
        
    /* End of Refs #55 */


        



  
  
  /* Tablesorter */
  $(".tablesorter").tablesorter( {sortList: [[0,0]]} );
  $(".tablesorter1d").tablesorter( {sortList: [[0,1]]} );
  $(".tablesorter2a").tablesorter( {sortList: [[1,0]]} );
  $(".tablesorter3a").tablesorter( {sortList: [[2,0]]} );
  $(".tablesorter4a").tablesorter( {sortList: [[3,0]]} );
  
  
  /* Tablesorter pager */
  $(".tablesorterpager").tablesorterPager({
    container: $(".tablesorterpagerdiv"), 
    positionFixed: false, 
    size: 50
  });
  
  
  /* Bootstrap */
  $('.tooltips').tooltip();
  
  
  
  
  /* jQueryUI Datepicker */
  $('.datepick').datepicker({ dateFormat: "yy-mm-dd" });
  $('#datepick_whdb').datepicker({
    dateFormat: "yy-mm-dd", 
    changeMonth: true,
    changeYear: true,
    onSelect: function(dateText, inst) {
      var url = $('#datepick_whdb_url').val() + dateText;
      window.location=url;
    }
  });
  
  /* //Fixing refs #45
  // Timepicker
  var startTag = "#working_hour_start";
  var endTag = "#working_hour_end";
  $(startTag).timePicker();
  $(endTag).timePicker();
  //var oldTimeVal = ($.timePicker(startTag).getTime());
  $(startTag).change(function()
  {
    if ($(endTag).val())
    {
      var duration = ($.timePicker(endTag).getTime() - $.timePicker(startTag).getTime());
      var time = $.timePicker(startTag).getTime();
      $.timePicker(endTag).setTime(new Date(new Date(time.getTime() + duration)));
      //oldTimeVal = time;
    }
  });
  
  $(endTag).change(function()
  {
    if($.timePicker(startTag).getTime() > $.timePicker(this).getTime()) {
      $(this).addClass("timepicker-error");
      
    }
    else {
      $(this).removeClass("timepicker-error");
    }
    var x = $.timePicker(startTag).getTime();
    var y = $.timePicker(endTag).getTime();
    var z = ( y-x ) / 60000;
    var minute = z % 60;
    var hour = (z-minute) / 60;
    $('#timetotal').html(hour+"h "+minute+"m");
  });
  */
  
}
);

