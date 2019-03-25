$(document).ready(function()
{
    $("#selectAccount").change(function()
    {
        if(!$(this).val().length)
        {
            $("#buttonRedeemFromAccount").hide();
            $("#formWrapper").hide();
            return;
        }
        if($(this).val() != 'new')
        {
            $("#buttonRedeemFromAccount").show();
            $("#formWrapper").hide();
            return;
        }
        $("#buttonRedeemFromAccount").hide();
        $("#formWrapper").show();
    });

    $("#buttonRedeemFromAccount").click(function()
    {
        $("#formWithAccount").submit();
    });
});