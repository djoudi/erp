<?php if (isset($title)) slot ('title', $title); ?>


<?php if (isset($activeClass)) slot('activeClass', $activeClass); ?>


<div class="pull-right">
    
    <a class="btn btn-info pull-right" href="<?php echo $back_url; ?>">Back to List</a>
    
    <?php if ( isset($rightList_title) && isset($rightList_items) ): ?>
    
        <br /><br />
        
        <table class="tablesorter table table-bordered table-condensed table-hover pull-right">
            <thead>
                <tr>
                    <th><?php echo $rightList_title; ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rightList_items as $item): ?>
                    <tr>
                        <td>
                            <?php echo $item; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    
    <?php endif; ?>

</div>


<form method="post">

    <table class="table table-hover table-bordered table-condensed">
        
        <?php echo $form; ?>
        
    </table>

    <div class="clearfix"></div>

    <div class="form-actions clearfix">
        
        <a class="btn" href="<?php echo $back_url; ?>">Back to List</a>
        
        <input class="btn btn-primary" type="submit" value="Save" />
        
        <?php if (!$form->isNew()): ?>
            <input class="btn pull-right" type="reset" value="Revert Changes" />
        <?php endif; ?>
        
    </div>

</form>
