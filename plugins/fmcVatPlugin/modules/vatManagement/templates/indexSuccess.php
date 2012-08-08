<?php slot ('title', "VAT Management") ?>

<?php if (!count ($list)): ?>

    <p>No VAT rate defined on the system. Please add a VAT value from below.</p>
    
<?php else: ?>

<table class="tablesorter table table-striped table-bordered table-condensed">
    <thead>
        <tr>
            <th>Rate</th>
            <th>Is Default?</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($list as $vat): ?>
            <tr>
                <td>
                    <?php echo $vat['rate']; ?>
                </td>
                <td>
                    <?php if ($vat->getIsDefault()): ?>
                        Default
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($vat->getIsActive()): ?>
                        <span class="label label-success">Enabled</span>
                    <?php else: ?>
                        <span class="label label-important">Disabled</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if ($vat->getIsActive()): ?>
                        <a class="btn btn-mini" href="<?php echo url_for('@vatManagement_disable?id='.$vat['id']); ?>">
                            Disable
                        </a>
                    <?php else: ?>
                        <a class="btn btn-mini" href="<?php echo url_for('@vatManagement_enable?id='.$vat->getId()); ?>">
                            Enable
                        </a>
                    <?php endif; ?>
                    
                    <?php if (!$vat->getIsDefault()): ?>
                        <a class="btn btn-mini btn-success" href="<?php echo url_for('@vatManagement_makeDefault?id='.$vat->getId() ); ?>">
                            Make Default
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php endif; ?>


<form action="" method="post">
    
    <?php echo $form->renderHiddenFields() ?>
    
    <div class="form-actions">
    
        <h4>Add new VAT</h4>
        Rate <?php echo $form['rate'] ?> 
        <input class="btn btn-success" type="submit" value="Add" />
        
    </div>
    
</form>
