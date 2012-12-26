<?php slot ('title', "Edit leave limits for: ".$employee) ?>


<?php slot ('activeClass', "#topmenu_workinghours"); ?>


<form method="post">

    <table class="table table-condensed table-bordered table-hover">
        
        <thead>
            <tr>
                <th>Leave Type</th>
                <th>Limit</th>
                <th>Default</th>
                <th>Used</th>
            </tr>
        
        </thead>
        
        <tbody>        
            <?php foreach ($leaveTypes as $type): ?>
                <tr>
                    <td>
                        <label class="control-label" for="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></label>
                    </td>
                    <td>
                        <?php
                            $value="";
                            foreach ($limits as $limit)
                            {
                                if ($type['id'] == $limit['type_id'])
                                {
                                    $value = $limit['leaveLimit'];
                                    break;
                                }
                            }
                        ?>
                        <input type="text" name="<?php echo $type['id']; ?>" id="<?php echo $type['id']; ?>" value="<?php echo $value; ?>">
                    </td>
                    
                    <td>
                        <?php echo $type['default_Limit']; ?>
                    </td>
                    
                    <td>
                        <?php echo whLeaveUser::countUsedLimit ($type['id'], $employee['id']); ?>
                    </td>
                    
                </tr>
            <?php endforeach; ?>
        </tbody>
        
    </table>

    <div class="form-actions">
        <a class="btn" href="<?php echo url_for('@workingHourLeaveLimit_list'); ?>">Back to List</a>
        <input class="btn btn-primary" type="submit" value="Save" />
    </div>

</form>

