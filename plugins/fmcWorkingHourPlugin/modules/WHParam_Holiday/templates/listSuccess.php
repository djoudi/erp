<?php slot ('title', "Holiday List") ?>

<!--
<script type="text/javascript">
    $("#topmenu_settings").addClass("active");
</script>
-->

<a class="pull-right btn btn-success" href="">New Holiday</a>

<!-- new button -->

<?php if (!count($items)): ?>

    <p>No records found.</p>

<?php else: ?>

    <table class="pull-left tablesorter tablesorterpager table table-hover table-condensed table-bordered">
        <thead>
            <tr>
                <th>Date</th>
                <th>Name</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $item): ?>
                <tr>
                    <td>
                        <?php echo $item['date']; ?>
                    </td>
                    <td>
                        <?php echo $item['name']; ?>
                    </td>                
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif; ?>

<div class="clearfix"></div>
