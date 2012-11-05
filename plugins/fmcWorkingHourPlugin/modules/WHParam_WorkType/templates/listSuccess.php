<?php slot ('title', "Work Types List") ?>

<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>

<a class="pull-right btn btn-success" href="<?php echo url_for('@whparam_worktype_new'); ?>">
    New Work Type
</a>

<?php if (!count($items)): ?>

    <p>No records found.</p>

<?php else: ?>

    <table class="pull-left tablesorter table table-hover table-condensed table-bordered">
        <thead>
            <tr>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <a href="<?php echo url_for('@whparam_worktype_edit?id='.$item['id']); ?>">
                            <?php echo $item['name']; ?>
                        </a>
                    </td>                
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

<div class="clearfix"></div>
