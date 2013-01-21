<?php slot ('title', "Invoicing Cost Forms") ?>

<?php slot ('activeClass', "#topmenu_costforms"); ?>

<?php if (!count($invoicings)): ?>

    <p>No invoicings found so far.</p>
    
<?php else: ?>

    <table class="table table-hover table-bordered table-condensed">
        <tr>
            <th>Id</th>
            <th>Date</th>
            <th>Invoiced By</th>
        </tr>
        <?php foreach ($invoicings as $invoicing): ?>
            <tr>
                <td>
                    <?php echo $invoicing['id']; ?>
                </td>
                <td>
                    <a href="<?php echo url_for("@costFormProcess_report?id={$invoicing['id']}"); ?>">
                        <?php echo $invoicing['invoicing_Date']; ?>
                    </a>
                </td>
                <td>
                    <?php echo $invoicing->getEmployee(); ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php endif; ?>
