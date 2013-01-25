<?php
    if (!isset($class)) $class = '';
    if (!isset($text)) $text = 'Are you sure you want to delete? <br />Warning! This operation is PERMANENT!';
    if (!isset($url)) $url = '';
    if (!isset($label)) $label = 'Delete';
    if (!isset($iconClass)) $iconClass = '';
    if (!isset($iconOnly)) $iconOnly = false;
?>

<?php if (!$url): ?>

    E_DeleteButton_MissingUrl
    
<?php else: ?>

    <?php $id = str_replace(array('/','.'),"",$url); ?>

    <!-- Button to trigger modal -->
    
    <a href="#<?php echo $id; ?>Modal" role="button" class="<?php echo $class; ?>" data-toggle="modal">
        
        <?php if ($iconClass): ?>
            <i class="<?php echo $iconClass; ?>"></i>
        <?php endif; ?>
        
        <?php if (!$iconOnly): ?>
            <?php echo $label; ?>
        <?php endif; ?>
    </a>
     
    <!-- Modal -->
    
    <div 
        id="<?php echo $id; ?>Modal" 
        class="modal hide" 
        tabindex="-1" 
        role="dialog" 
        aria-labelledby="<?php echo $id; ?>Modal" 
        aria-hidden="true"
    >
        <div class="modal-body">
            <p><?php echo $text; ?></p>
        </div>
        
        <div class="modal-footer">
            
            <a class="btn btn-primary" href="<?php echo $url; ?>">
                <?php echo $label; ?>
            </a>
            
            <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
            
        </div>
    </div>

<?php endif; ?>
