<?php if ($itemCount == $limit): ?>

    <div class="alert">
        
        <a class="close" data-dismiss="alert" href="#">×</a>
        
        More than <strong><?php echo $limit; ?></strong> results found, 
        showing first <strong><?php echo $limit; ?></strong> results. Please filter your result.
    
    </div>

<?php endif; ?>
