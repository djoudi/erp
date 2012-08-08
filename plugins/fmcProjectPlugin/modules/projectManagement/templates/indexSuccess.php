<?php slot ('title', "Project List") ?>

<p>
    <a class="btn btn-primary" href="<?php echo url_for('projectManagement_new'); ?>">New project</a>
</p>

<?php if (isset($filter)): ?>
    <?php include_partial ('fmcCore/filterForm', array(
    'filter'=>$filter, 
    'filtered'=>$filtered, 
    'count'=>count($items)
    )); ?>
<?php endif; ?>

<table class="tablesorter3a tablesorterpager table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th>Status</th>
            <th>Customer</th>
            <th>Project Code</th>
            <th>Project Title</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($items as $project): ?>
            <tr>
                <td>
                    <?php echo $project['status']; ?>
                </td>
                <td>
                    <?php echo $project->getCustomers(); ?>
                </td>
                <td>
                    <a href="<?php echo url_for("@projectManagement_edit?id=".$project->getId()); ?>">
                        <?php echo $project->getCode(); ?>
                    </a>
                </td>
                <td>
                    <?php echo $project['title']; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

