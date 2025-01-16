$('#link_modal_evolucao').click(function () {
    new bootstrap.Modal(document.getElementById('ModalEvolucaoGeral')).show();
})


$('.link_alt_status').click(function () {
    new bootstrap.Modal(document.getElementById('ModalAltStatus')).show();

    const $id_cliente = $(this).data('cliente');

    $('#cliente_id_kanban').val($id_cliente);
});
