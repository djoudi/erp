<?php
    if (!isset($class)) $class = '';
    if (!isset($text)) $text = 'Are you sure you want to delete?';
    if (!isset($url)) $url = '';
    if (!isset($label)) $label = 'Delete';
    if (!isset($hasIcon)) $hasIcon = $class ? true : false;
?>

<?php if (!$url): ?>

    E_MissingUrl
    
<?php else: ?>

        <a 
        class='<?php echo $class; ?>'
        onclick="if (confirm('<?php echo $text; ?>')) parent.location='<?php echo $url; ?>' "
        >
            <?php if ($hasIcon): ?>
                <i class="icon-remove icon-white"></i>
            <?php endif; ?>
            
            <?php echo $label; ?>
            
        </a>

<?php endif; ?>
