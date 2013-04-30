<?php slot ('title', "Project List") ?>



<?php slot ('activeClass', "#topmenu_settings"); ?>



<p>
    <strong>Quick find : </strong>
        
    <?php include_partial ('fmcCore/typeahead', array(
        'items' => $items,
        'url' => '@projectManagement_edit?id=',
        'class' => "projectTypeahead",
        'col1' => "code",
        'seperator' => " - ",
        'col2' => "title",
    )); ?>
    
</p>


<?php if (isset($filter)): ?>
    <?php include_partial ('fmcCore/filterForm', array(
        'filter'=>$filter, 
        'filtered'=>$filtered, 
        'count'=>count($items),
        'new_url'=>url_for('@projectManagement_new'),
        'new_text'=>"New Project"
    )); ?>
<?php endif; ?>


<?php if (count($items)): ?>
    <table class="tablesorter3a table table-hover table-bordered table-condensed">
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
                        <a href="<?php echo url_for("@projectManagement_edit?id=".$project['id']); ?>">
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
<?php endif; ?>
