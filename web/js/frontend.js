$(document).ready(function() 
{
    
    /* Refs #55 - Submenu under Topmenu , ioPlugin with Bootstrap */
        $("ul#layout_top_menu > li.dropdown > a").addClass("dropdown-toggle");
        $("ul#layout_top_menu > li.dropdown > a").attr("data-toggle", "dropdown");
        $("ul#layout_top_menu > li.dropdown > ul").addClass("dropdown-menu");
        $("ul#layout_top_menu > li.dropdown > ul").attr("role", "menu");
        $("ul#layout_top_menu > li > a").not(":first").append(' <b class="caret"></b>'); /* Shows dropdown arrows */
    /* End */
    
    
    /* Tablesorter */
        $(".tablesorter").tablesorter( {sortList: [[0,0]]} );
        $(".tablesorter1d").tablesorter( {sortList: [[0,1]]} );
        $(".tablesorter2a").tablesorter( {sortList: [[1,0]]} );
        $(".tablesorter3a").tablesorter( {sortList: [[2,0]]} );
        $(".tablesorter4a").tablesorter( {sortList: [[3,0]]} );
    /* End */
    
    
    /* Tablesorter Pager */
        $(".tablesorterpager").tablesorterPager({
            container: $(".tablesorterpagerdiv"), 
            positionFixed: false, 
            size: 250
        });
    /* End */
    
    
    /* jQueryUI Datepicker */
        
        $('.datepick').datepicker({ dateFormat: "yy-mm-dd" });
        
        $('#datepick_whdb').datepicker({
            dateFormat: "yy-mm-dd", 
            defaultDate: $("#datepick_whdb_url").attr("defaultdate"), 
            changeMonth: true, 
            firstDay: 1, 
            numberOfMonths: 1, 
            changeYear: true, 
            onSelect: function(dateText, inst) {
                var url = $('#datepick_whdb_url').val() + dateText;
                window.location=url;
            }
        });
    /* End */
    
    
}
);
