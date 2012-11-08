<?php
    $output = date('Y-m-d, l', strtotime($date));
    
    if ($date == date('Y-m-d'))
    {
        $output .= ' (Today)';
    }
    elseif ($date == date('Y-m-d', strtotime('yesterday'))) 
    {
        $output .= ' (Yesterday)';
    }
    elseif ($date == date('Y-m-d', strtotime('tomorrow')))
    {
        $output .= ' (Tomorrow)';
    }
?>

<?php echo $output; ?>
