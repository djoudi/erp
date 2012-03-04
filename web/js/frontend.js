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
  
}
);
