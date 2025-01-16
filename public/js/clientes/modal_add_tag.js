$('#link_modal_add_tag').click(function(){
    new bootstrap.Modal(document.getElementById('ModalAddTag')).show();
});

$('#add_tag').click(function () {

    tag_id = $('#select_tag').val();
    id_cliente = $('.edit_id_cli').text();

    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'get',
        url: '/admin/clientes/add_tag',
        contentType: 'application/json',
        data: {
            id_tag: tag_id,
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
                title: "Erro ao adicionar tag"
            });
        },
        complete: function () {
       
        }
    });

});