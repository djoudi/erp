<?php
    if (!isset($class)) $class = '';
    if (!isset($text)) $text = 'Are you sure you want to delete?';
    if (!isset($url)) $url = '';
    if (!isset($label)) $label = 'Delete';
    if (!isset($iconClass)) $iconClass = '';
?>

<?php if (!$url): ?>

    E_DeleteButton_MissingUrl
    
<?php else: ?>

        <a 
        class='<?php echo $class; ?>'
        onclick="if (confirm('<?php echo $text; ?>')) parent.location='<?php echo $url; ?>' "
        >
            <?php if ($iconClass): ?>
                <i class="<?php echo $iconClass; ?>"></i>
            <?php endif; ?>
            
            <?php echo $label; ?>
            
        </a>

<?php endif; ?>
