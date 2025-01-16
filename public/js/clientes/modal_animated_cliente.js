
// Depois de 3 segundos, mostra novamente o modal
setTimeout(function() {
    $("#animatedModal").css("display", "block");
}, 3000); // 3000ms = 3 segundos

$("#animate_modal_cliente").animatedModal(
    {
        'animatedIn': 'bounceInUp',
        'overflow': 'hidden',
        'color': '#ffffff',
        'animationDuration': '.10s'
    }
);


$('#tabelaClientes tbody').on('click', '.btn_edit_ma', function () {
    var url_iframe = $(this).data('target');

    $('.page_edit_cliente_iframe').attr('src', url_iframe);

    $('.link_teste').trigger('click');

});


$('.close-animatedModal').click(function () {
    $('.page_edit_cliente_iframe').attr('src', '');
});


$("#animate_modal_cliente")
