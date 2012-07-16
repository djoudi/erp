<tr>
    
    <form action="" method="post">
        
        <?php echo $form->renderHiddenFields(); ?>
    
        <td>
            <?php echo $form['project_id']; ?>
        </td>
        
        <td id="time3">
            <?php echo $form['start']; ?>
        </td>
        
        <td id="time4">
            <?php echo $form['end']; ?>
        </td>
        
        <td>
            <span id="timetotal"></span>
        </td>
        
        <td>
            <?php echo $form['worktype_id']; ?>
        </td>
        
        <td>
            <?php echo $form['comment']; ?>
        </td>
        
        <td>
            <input class="btn btn-mini" type="submit" value="Add" />
        </td>
        
    </form>
    
</tr>
