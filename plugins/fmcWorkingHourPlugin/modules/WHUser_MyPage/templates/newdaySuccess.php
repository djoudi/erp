<?php slot('title', 'Create new day'); ?>

<div class="row">
    
    <div class="span3" style="padding: 10px 15px 0 0;">
        
        <p>Select a date above to go to a day.</p>
        
        <?php include_partial ('datepicker', array('date'=>$date)); ?>
        
    </div>
        
    <div class="span8">
        
        <h4><?php include_partial('fmcCore/goodDate', array('date'=>$date)); ?></h4>
        
        <ul id="myTab" class="nav nav-tabs">
            <li class="active"><a href="#normal" data-toggle="tab">New Work Day</a></li>
            <li class=""><a href="#leave" data-toggle="tab">New Leave</a></li>
        </ul>
    
        <div class="tab-content">
            
            <div class="tab-pane fade active in" id="normal">
                
                <p>To start a new day, please enter your <strong>office entrance</strong> date.</p>
                
                <form class="form-horizontal" method="post">
                    
                    <table class="table table-bordered table-hover table-condensed">
                        <?php echo $form; ?>
                    </table>
                
                    <div class="form-actions">
                        <input type="submit" class="btn btn-primary" value="Continue" />
                    </div>
                
                </form>
                
            </div>
            
            <div class="tab-pane fade" id="leave">
                
                
                
                <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
            </div>
            
        </div>

    
    
    </div>
    
</div>






</div>





