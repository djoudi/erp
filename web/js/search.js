$(document).ready(function()
{
    $('#ajax_submit').hide();
    $('#ajax_input').keyup(function(key)
    {
        $('#ajax_content').load(
            $(this).parents('form').attr('action'),
            { query: this.value + '*' }
        );
    });
});
