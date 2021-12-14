
$(document).on('click', '#bulk_actions_btn', function (e) {
    //
    // If popover is visible: do nothing
    //
    if ($(this).prop('popShown') == undefined) {
       $(this).prop('popShown', true).popover('show');
    }
});

$(function () {
    $('#bulk_actions_btn').on('hide.bs.popover', function (e) {
        //
        // on hiding popover stop action
        //
        e.preventDefault();
    });
});
