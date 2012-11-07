<?php slot ('title', "Work Types List") ?>

<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>

<a class="pull-right btn btn-success" href="<?php echo url_for('@whparam_worktype_new'); ?>">
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
                        
                            <?php $tmp = $items[$i]['code']; $curLetter = $tmp[0]; ?>
                
                            <?php if ( ($prevLetter!=$curLetter) && ($prevLetter!="") ): ?>
                                </ul>
                                </div>
                                <div class="span3">
                                <ul>
                            <?php endif; ?>
                        
                            <li>
                                <?php echo $items[$i]['code']; ?> - 
                                <a href="<?php echo url_for('@whparam_worktype_edit?id='.$items[$i]['id']); ?>">
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
