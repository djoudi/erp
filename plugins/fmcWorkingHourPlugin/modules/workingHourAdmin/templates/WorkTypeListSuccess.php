<?php slot ('title', "Work Types Management") ?>


<script type="text/javascript">
    $("#topmenu_settings").addClass("active");
</script>


<?php if (isset($filter)): ?>
    <?php include_partial ('fmcCore/filterForm', array(
        'filter'=>$filter, 
        'filtered'=>$filtered, 
        'count'=>count($items),
        'new_url'=>url_for('@workingHourWorkType_new'),
        'new_text'=>"New Work Type"
    )); ?>
<?php endif; ?>


<table class="tablesorter tablesorterpager table table-bordered table-condensed">
    <thead>
        <tr>
            <th>Code</th>
            <th>Title</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td><?php echo $item['code']; ?></td>
                <td>
                    <a href="<?php echo url_for('@workingHourWorkType_edit?id='.$item['id']); ?>">
                        <?php echo $item['title']; ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
