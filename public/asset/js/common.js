$(function () {
    $('[data-toggle="tooltip"]').tooltip();
    $(".goBack").click(function()
    {
        window.history.back();
    });
});