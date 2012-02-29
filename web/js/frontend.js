$(document).ready(function() 
{
  // Tablesorter
  $(".tablesorter").tablesorter( {sortList: [[0,0]]} );
  $(".tablesorter2a").tablesorter( {sortList: [[1,0]]} );
  $(".tablesorter4a").tablesorter( {sortList: [[3,0]]} );
  
  // Bootstrap
  $('.tooltips').tooltip();
  $('.datepick').datepicker({ dateFormat: "yy-mm-dd" });
  
}
);
