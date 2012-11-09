<?php slot('title', 'View current date' ); ?>

<script type="text/javascript">
    $("#topmenu_workinghours").addClass("active");
</script>

<p class="pull-left">Note: To change office entrance hour, you have to delete this day.</p>

<a class="btn btn-danger btn-small pull-right" onclick="
      if (confirm('If you continue, all records for today will be DELETED. Are you sure?'))
        parent.location='<?php echo $cancelUrl; ?>'
">
    <i class="icon-remove icon-white"></i>
    Delete Day
</a>

<div class="clearfix"></div>

<hr style="margin: 0px 0px 10px 0px" />

<table class="table table-condensed table-hover table-bordered">
    <tr>
        <th>Office entrance</th>
        <td>09:00</td>
    </tr>
</table>


<table class="table table-bordered table-hover table-condensed">
    <thead>
        <tr>
            <th>Project</th>
            <th>Type of Work</th>
            <th>From</th>
            <th>To</th>
            <th>Comments</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
    
    
    <tfoot>
        <tr>
            <form class="form-inline" method="post">
                <?php echo $form->renderHiddenFields(); ?>
                <td>
                    <?php echo $form['project_id']; ?>
                </td>
                <td>
                    <?php echo $form['type_id']; ?>
                </td>
                <td>
                    <?php echo $form['start']; ?>
                </td>
                <td>
                    <?php echo $form['end']; ?>
                </td>
                <td>
                    <?php echo $form['comment']; ?>
                </td>
                <td>
                    <input class="btn btn-mini" type="submit" value="Add"/>
                </td>
            </form>
        </tr>
    </tfoot>
</table>



<pre>
<?php print_r($dayIOrecords->toArray()); ?>
</pre>
