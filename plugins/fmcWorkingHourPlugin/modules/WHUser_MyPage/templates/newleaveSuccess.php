<?php slot('title', 'New leave request: '.$leaveType ); ?>

<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>


<div class="row">
    
    <?php include_partial ('datepicker', array('date'=>$date)); ?>
        
    <div class="span8" style="padding-top: 40px">
        
        <form class="form-horizontal" method="post">
            
            <table class="table table-condensed table-bordered table-hover">
                <?php echo $form; ?>
            </table>
            
            <div class="form-actions">
                <a class="btn" href="<?php echo url_for('@whuser_day?date='.$date); ?>">Go Back</a>
                <input class="btn btn-primary" type="submit" value="Create Request" />
            </div>
            
        </form>
        
    </div><!-- .span8 -->
    
</div><!-- .row -->
