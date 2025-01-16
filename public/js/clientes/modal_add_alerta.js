$('#link_add_alerta').click(function(){
    new bootstrap.Modal(document.getElementById('ModalAddAlerta')).show();
})


$('#add_alerta').click(function () {

    id_cliente = $('.edit_id_cli').text();

    var formData = $('.form_add_alerta').serializeArray();
    var jsonData = {};

    $(formData).each(function (index, obj){
        jsonData[obj.name] = obj.value;
    });

    jsonData['id_cliente'] = id_cliente;
    jsonData['data_cliente'] = $('#data').val();
    jsonData['horario_cliente'] = $('#horas').val();
    jsonData['observacao_cliente']= $('#observacao_cliente').val();

        const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 8000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });


    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'get',
        url: '/admin/clientes/add_alerta',
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
                title: "Erro ao adicionar alerta"
            });
        },
        complete: function () {
       
        }
    });

});