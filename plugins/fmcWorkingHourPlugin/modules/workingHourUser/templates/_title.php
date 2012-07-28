<?php
  $title = $text.' for : ';
  
  $title .= date('Y-m-d, l', strtotime($date));
  if ($date == date('Y-m-d')) $title .= ' (Today)';
  elseif ($date == date('Y-m-d', strtotime('yesterday'))) $title .= ' (Yesterday)';
  elseif ($date == date('Y-m-d', strtotime('tomorrow'))) $title .= ' (Tomorrow)';
  
  slot ('title', $title);
?>
