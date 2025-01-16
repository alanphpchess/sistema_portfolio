
$('.link_edit_contato').click(function () {

    id_contato = $(this).closest('.accordion-body').find('[data-id]').data('id');

    $("#ModalEditContato").on("show.bs.modal", function () {

        

    });

    new bootstrap.Modal(document.getElementById('ModalEditContato')).show();

    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'get',
        url: '/admin/clientes/get_contato',
        contentType: 'application/json',
        data: {
            id_contato: id_contato,
        },
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            $('#edit_data').val(data.dia);
            $('#edit_horas').val(data.horas);
            $('#edit_comunicacao').val(data.comunicacao);
            $('#edit_observacao').val(data.observacao);
        },
        error: function (xhr, status, error) {

        },
        complete: function () {

        }
    });
})


$('#edit_contato').click(function () {

    // id_cliente = $('.edit_id_cli').text();

    // var formData = $('.form_add_contato').serializeArray();
    // var jsonData = {};

    // $(formData).each(function (index, obj){
    //     jsonData[obj.name] = obj.value;
    // });

    // jsonData['id_cliente'] = id_cliente;

    // $.ajax({
    //     headers: {
    //         'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
    //     },
    //     method: 'get',
    //     url: '/admin/clientes/add_contato',
    //     contentType: 'application/json',
    //     data: jsonData,
    //     dataType: 'json',
    //     beforeSend: function () {
    //     },
    //     success: function (data) {
    //         if (data.status == true) {

    //             window.location.reload();

    //         } else {

    //             Toast.fire({
    //                 icon: "error",
    //                 title: data.message
    //             });

    //         }
    //     },
    //     error: function (xhr, status, error) {

    //         Toast.fire({
    //             icon: "error",
    //             title: "Erro para editar contato"
    //         });
    //     },
    //     complete: function () {

    //     }
    // });

});