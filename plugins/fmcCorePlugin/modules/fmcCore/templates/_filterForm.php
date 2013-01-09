<div class="FilterForm well" style="padding: 10px !important;">



    <div style="margin-right: 15px;" class="pull-left">

        <?php if ($filtered): ?>
        
            <a class="btn btn-primary pull-left" onclick="$('#topFilterForm').toggle()" style="margin-right: 5px;">
                <i class="icon-search icon-white"></i>
                Open/Close Filter
            </a>
        
            <form class="pull-left" style="margin: 0 10px 0 0;" action="" method="post" <?php if (!$filtered): ?>style="display:none"<?php endif; ?>>
                <?php echo $filter->renderHiddenFields(); ?>
                <input class="btn btn-primary" type="submit" name="_reset" value="Show All (Reset Filter)" />
            </form>
        
        <?php else: ?>
        
            <a class="btn btn-primary" onclick="$('#topFilterForm').toggle()">
                <i class="icon-search icon-white"></i>
                Filter Results 
            </a>
      
        <?php endif; ?>
    
    </div>
    
    
    <?php if ($count): ?>
    
        <strong><?php echo $count; ?></strong> results found. &nbsp;
        
    <?php else: ?>
    
        No results found.
        
    <?php endif; ?>
    
    
    <?php if(isset($count)): ?>
        <?php #include_partial ('fmcCore/tspager', array('count'=>$count)); ?>
    <?php endif; ?>
    
    
    <?php if ( isset($new_url) && isset($new_text) ): ?>
        <div class="pull-right">
            <a class="btn btn-success" href="<?php echo $new_url; ?>"><?php echo $new_text; ?></a>
        </div>
    <?php endif; ?>
    
    
    <div style="clear: both;"></div>
    
    <form id="topFilterForm" method="post" style="display:none" class="margintop10 marginbot0">
        <table class="table table-hover table-bordered table-condensed marginbot0">
            <?php echo $filter; ?>
            <tr>
                <td></td>
                <td style="text-align: right;">
                    <input class="btn" type="submit" name="_reset" value="Show All" />
                    <input class="btn btn-info" type="submit" value="Filter" />&nbsp;
                </td>
            </tr>
        </table>
    </form>
    
    <div style="clear: both;"></div>
    
    
</div>


<?php if (isset($limit)): ?>

    <?php if ($count == $limit): ?>

        <div class="alert">
            
            <a class="close" data-dismiss="alert" href="#">×</a>
            
            More than <strong><?php echo $limit; ?></strong> results found, 
            showing first <strong><?php echo $limit; ?></strong> results. Please filter your result.
        
        </div>

    <?php endif; ?>

<?php endif; ?>
