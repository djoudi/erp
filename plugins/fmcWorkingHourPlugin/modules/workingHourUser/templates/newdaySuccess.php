<?php include_partial ('title', array('date'=>$date, 'text'=>'New day entrance')); ?>

<script>
	$(function() {
		$( "#tabs" ).tabs();
	});
</script>


<div id="tabs">
    
	<ul>
		<li><a href="#workday">Work Day</a></li>
		<li><a href="#leaveday">Leave</a></li>
	</ul>
    
	<div id="workday">
        
        <p>To start a work day, please enter your office entrance hour.</p>
        
        <form action="" method="post">
  
            <?php echo $form->renderHiddenFields(); ?>

            <table class="table table-striped table-bordered table-condensed">
                <tr>
                    <th><?php echo $form['time']->renderLabel(); ?></th>
                    <td><?php echo $form['time']; ?></td>
                </tr>  
            </table>

            <div class="form-actions">
                <a class="btn" href="javascript:history.back(1)" >Cancel</a>
                <input type="submit" class="btn btn-success" value="Save and Continue"></input>
            </div>

        </form>

        
	</div>
    
	<div id="leaveday">
        
		<p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor. Aenean aliquet fringilla sem. Suspendisse sed ligula in ligula suscipit aliquam. Praesent in eros vestibulum mi adipiscing adipiscing. Morbi facilisis. Curabitur ornare consequat nunc. Aenean vel metus. Ut posuere viverra nulla. Aliquam erat volutpat. Pellentesque convallis. Maecenas feugiat, tellus pellentesque pretium posuere, felis lorem euismod felis, eu ornare leo nisi vel felis. Mauris consectetur tortor et purus.</p>
        
	</div>
    
</div>
