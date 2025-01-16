$('#add_status').click(function () {

    status_id = $('#select_status').val();
    id_cliente = $('.edit_id_cli').text();

    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'get',
        url: '/admin/clientes/add_status',
        contentType: 'application/json',
        data: {
            id_status: status_id,
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
                title: "Erro para adicionar"
            });
        },
        complete: function () {
       
        }
    });

});