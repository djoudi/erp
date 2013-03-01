<?php if (!isset($date)) $date = date("Y-m-d"); ?>

<p>To create a <strong>Leave Request</strong>, please select desired leave type below.</p>

<?php foreach ($leaveTypes as $type): ?>

    <p class="text-info">
        
        <?php
            $used = whLeaveUser::countUsedReservedLimit ($type['id'], NULL, $date);
            $available = whLeaveUser::countAvailableLimit ($type['id']);
            $isDisabled = $available > $used ? false : true;
            
            $class = $isDisabled ? "disabled" : "btn-success";
            
            $url = url_for ('workingHourLeave_new', array(
                'type_id' => $type['id'],
                'date' => $date
            ));
            $href = $isDisabled ? "#" : $url;
        ?>
        
        <a href="<?php echo $href; ?>" class="btn <?php echo $class; ?>">
            <?php echo $type; ?>
        </a> 
         
        (<?php echo $used; ?> of 
        <?php echo $available; ?> used)
    </p>
    
<?php endforeach; ?>
