<?php slot ('title', "Edit leave limits for: ".$employee) ?>

<?php slot ('activeClass', "#topmenu_workinghours"); ?>

<form method="post">

    <table class="table table-condensed table-bordered table-hover">
        <?php foreach ($leaveTypes as $type): ?>
            <tr>
                <th>
                    <label class="control-label" for="<?php echo $type['id']; ?>"><?php echo $type['name']; ?></label>
                </th>
                <td>
                    <?php
                        $value=0;
                        foreach ($limits as $limit)
                        {
                            if ($type['id'] == $limit['type_id'])
                            {
                                $value = $limit['leaveLimit'];
                                break;
                            }
                        }
                    ?>
                    <?php if ($value): ?>
                        <input type="text" name="<?php echo $type['id']; ?>" id="<?php echo $type['id']; ?>" value="<?php echo $value; ?>">
                    <?php else: ?>
                        <input type="text" name="<?php echo $type['id']; ?>" id="<?php echo $type['id']; ?>" value="">
                        Default : <?php echo $type['default_Limit']; ?>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <div class="form-actions">
        <a class="btn" href="<?php echo url_for('@workingHourLeaveLimit_list'); ?>">Back to List</a>
        <input class="btn btn-primary" type="submit" value="Save" />
    </div>

</form>

