<table class="tablesorter table table-bordered table-condensed table-hover pull-right">
    <thead>
        <tr>
            <th>Employees of this department</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($item->getUsers() as $user): ?>
            <tr>
                <td>
                    <?php echo $user; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include_partial('fmcCore/recordForm', array(
    "form" => $form, 
    "title" => "Department: ".$item, 
    "activeClass" => "#topmenu_settings", 
    "back_url" => url_for("@departmentManagement_list")
)); ?>
