<?php
  $title = 'Working Hours for : ';
  $title .= date('Y-m-d, l', strtotime($date));
  if ($date == date('Y-m-d')) $title .= ' (Today)';
  elseif ($date == date('Y-m-d', strtotime('yesterday'))) $title .= ' (Yesterday)';
  elseif ($date == date('Y-m-d', strtotime('tomorrow'))) $title .= ' (Tomorrow)';
  
  slot ('title', $title);
?>





<?php if ($isnewday): ?>

  <p>
    To continue, first you have to enter your time of enterance.
  </p>

<?php else: ?>
  
  <?php include_partial ('editdayitems', array('items'=>$items, 'date'=>$date, 'form'=>$form)); ?>
  
<?php endif; ?>
