<?php slot ('title', "Other Parameters") ?>

<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>

<?php //only if necessary
/*
<a class="pull-right btn btn-success" href="<?php echo url_for('@whparam_settings_new'); ?>">New Parameter</a>
*/ ?>

<?php if (!count($items)): ?>

    <p>No records found.</p>

<?php else: ?>

    <table class="pull-left tablesorter table table-hover table-condensed table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <a href="<?php echo url_for('@whparam_settings_edit?id='.$item['id']); ?>">
                            <?php echo $item['param']; ?>
                        </a>
                    </td>
                    <td>
                        <?php echo $item['description']; ?>
                    </td>
                    <td>
                        <?php echo $item['value']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

<div class="clearfix"></div>
