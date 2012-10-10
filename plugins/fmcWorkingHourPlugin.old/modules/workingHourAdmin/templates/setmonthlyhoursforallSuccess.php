<?php slot ('title', "Set monthy hours for all users"); ?>

<script type="text/javascript">
    $("#topmenu_settings").addClass("active");
</script>


<form method="post">
    <table class="table table-bordered table-condensed">
        <tr>
            <th>Monthy Working Hours Limit</th>
            <td>
                <input type="text" name="limit" />
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="submit" class="btn btn-warning pull-right"
                    value="Set for all users" 
                    onClick="return confirm(
                    'This operation will set specified monthly hours for ALL users. Are you sure you want to continue?');"
                >  
            </td>
        </tr>    
    </table>
</form>
