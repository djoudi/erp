<?php
    $text = date('Y-m-d, l', strtotime($date));
    
    if ($date == date('Y-m-d'))
        $text .= ' (Today)';
    elseif ($date == date('Y-m-d', strtotime('yesterday')))
        $text .= ' (Yesterday)';
    elseif ($date == date('Y-m-d', strtotime('tomorrow')))
        $text .= ' (Tomorrow)';
    
    echo $text;
        
?>
