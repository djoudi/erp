<?php if (!isset($date)) $date = date("Y-m-d"); ?>

<p>To create a <strong>Leave Request</strong>, please select desired leave type below.</p>

<?php foreach ($leaveTypes as $type): ?>

    <p class="text-info">
        
        <?php
            $used = Fmc_Wh_Day::getMyLeaveUsage($type['id']);
            $available = Fmc_Wh_Day::getMyLeaveLimit($type['id']);
            $isDisabled = $available > $used ? "btn-success" : "disabled";
            
            #$url = url_for('@whuser_newleaverequest_day?date='.$date.'&type='.$type['id']);
            $url = url_for('@whuser_day_leaverequest_edit?type_id='.$type['id'].'&date='.$date);
            
            $href = $available > $used ? $url : "#";
        ?>
        
        <a href="<?php echo $href; ?>" class="btn <?php echo $isDisabled; ?>">
            <?php echo $type; ?>
        </a>    
        
        ( <?php echo $used; ?> of 
        <?php echo $available; ?> used. )
    </p>
    
<?php endforeach; ?>
