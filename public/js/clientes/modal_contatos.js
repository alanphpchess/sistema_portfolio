$('#link_add_contato').click(function(){
    new bootstrap.Modal(document.getElementById('ModalAddContato')).show();
})


$('#add_contato').click(function () {

    id_cliente = $('.edit_id_cli').text();

    var formData = $('.form_add_contato').serializeArray();
    var jsonData = {};


    
    $(formData).each(function (index, obj){
        jsonData[obj.name] = obj.value;
    });

    jsonData['id_cliente'] = id_cliente;
    jsonData['data_cliente'] = $('#data').val();
    jsonData['horario_cliente'] = $('#horas').val();
    jsonData['observacao_cliente']= $('#observacao_cliente').val();

    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'get',
        url: '/admin/clientes/add_contato',
        contentType: 'application/json',
        data: jsonData,
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
                title: "Erro ao adicionar contato"
            });
        },
        complete: function () {
       
        }
    });

});