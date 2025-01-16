
$(document).ready(function () {
    $('.form_select').select2({
        width: '100%',
        height: '100%'
    });

    $('.form_select_modal').select2({
        width: '100%',
        height: '100%',
        dropdownParent: $(this).parent(),
    });
});
