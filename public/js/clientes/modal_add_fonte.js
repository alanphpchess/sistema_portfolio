$('#link_modal_add_fonte').click(function(){
    new bootstrap.Modal(document.getElementById('ModalAddFonte')).show();
});

$('#add_fonte').click(function () {

    fonte_id = $('#select_fonte').val();
    id_cliente = $('.edit_id_cli').text();

    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'get',
        url: '/admin/clientes/add_fonte',
        contentType: 'application/json',
        data: {
            id_fonte: fonte_id,
            id_cliente: id_cliente
        },
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            if (data.status == true) {

                window.location.reload();
              
            } else {

                Toast.fire({
                    icon: "error",
                    title: data.message
                });

            }
        },
        error: function (xhr, status, error) {

            Toast.fire({
                icon: "error",
                title: "Erro ao adicionar fonte"
            });
        },
        complete: function () {
       
        }
    });

});