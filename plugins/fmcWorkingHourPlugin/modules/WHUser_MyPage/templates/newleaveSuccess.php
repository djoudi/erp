<?php slot('title', Fmc_Wh_Day::getGoodDate ($date) ); ?>

<div class="row">
    
    <div class="span3" style="padding: 5px 20px 0 0;">
        <p>Select a date above to go to a day.</p>
        <?php include_partial ('datepicker', array('date'=>$date)); ?>
    </div>
        
    <div class="span8">
        
        <h4>New leave request</h4>
        
        <form class="form-horizontal" method="post">
            
            <table class="table table-condensed table-bordered table-hover">
                <?php echo $form; ?>
            </table>
            
            <div class="form-actions">
                <input class="btn btn-primary" type="submit" value="Create Request" />
            </div>
            
        </form>
        
        


    
    </div><!-- .span8 -->
    
</div><!-- .row -->
