<?php slot ('title', "Work Types List") ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<a class="pull-right btn btn-primary" href="<?php echo url_for('@workingHourWorkType_new'); ?>">
    New Work Type
</a>

<?php if (!count($items)): ?>

    <p>No records found.</p>

<?php else: ?>

    <div class="row">
        <div class="span10">
            <div class="row">
                <div class="span3">
                    <ul>
                        <?php $prevLetter = ""; ?>
                        
                        <?php for ($i=0; $i<count($items); $i++): ?>
                        
                            <?php $tmp = $items[$i]['name']; $curLetter = $tmp[0]; ?>
                
                            <?php if ( ($prevLetter!=$curLetter) && ($prevLetter!="") ): ?>
                                </ul>
                                </div>
                                <div class="span3">
                                <ul>
                            <?php endif; ?>
                        
                            <li>
                                <a href="<?php echo url_for('@workingHourWorkType_edit?id='.$items[$i]['id']); ?>">
                                    <?php echo $items[$i]['name']; ?>
                                </a>
                            </li>
                            
                            <?php $prevLetter = $curLetter; ?>
                            
                        <?php endfor; ?>
        
                    </ul>
                </div>
            </div>
        </div>
    </div>

<?php endif; ?>
