<table class="tablesorter tablesorterpager table table-hover table-bordered table-condensed">
    <thead>
        <tr>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $item): ?>
            <tr>
                <td>
                    <a href="<?php echo url_for('@customerManagement_edit?id='.$item["id"]); ?>">
                        <?php echo $item->getName(); ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
