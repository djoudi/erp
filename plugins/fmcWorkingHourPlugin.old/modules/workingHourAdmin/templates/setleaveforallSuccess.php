<?php slot ('title', "Set leave limits for all users"); ?>

<script type="text/javascript">
    $("#topmenu_settings").addClass("active");
</script>


<form method="post">
    <table class="table table-bordered table-condensed">
        <tr>
            <th>Type</th>
            <td>
                <select name="type">
                    <option value="IllnessWReport" selected>Illness (with Report)</option>
                    <option value="IllnessWoReport">Illness (without Report)</option>
                    <option value="PaidVacation">Paid Vacation</option>
                    <option value="UnpaidVacation">Unpaid Vacation</option>
                    </select>            
            </td>
        </tr>
        <tr>
            <th>Limit</th>
            <td>
                <input type="text" name="limit" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" class="btn btn-warning pull-right"
                    value="Set leave for all users" 
                    onClick="return confirm(
                    'This operation will set specified leave limits for ALL users. Are you sure you want to continue?');"
                >  
            </td>
        </tr>    
    </table>
</form>
