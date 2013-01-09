<?php if (!isset($showItems)) $showItems = 8; ?>


<input 
    class="<?php echo $class; ?>"
    type="text" 
    class="span3" 
    data-provide="typeahead" 
    data-items="<?php echo $showItems; ?>"
>


<script>
$(':input.<?php echo $class; ?>').typeahead(
{
    source: function(query, process)
    {
        objects = [];
        map = {};
        var data = [
            <?php foreach ($items as $item): ?>
                <?php $label = $item[$col1]; ?>
                <?php if (isset($col2)) if ($item[$col2]) $label .= $seperator.$item[$col2]; ?>
                {
                    "id" : <?php echo $item['id']; ?> , 
                    "label" : "<?php echo $label; ?>"
                },
            <?php endforeach; ?>
        ];
        $.each(data, function(i, object)
        {
            map[object.label] = object;
            objects.push(object.label);
        });
        process(objects);
    },
    updater: function(item)
    {
        var url = "<?php echo url_for($url); ?>" + map[item].id;
        $('.<?php echo $class; ?>').val("");
        window.location = url;
    }
}); 
</script>
