$('#tabelaEmpresa tbody').on('click', '.btn-editar-empresa', function () {

    var row = $(this).closest('tr');
    var tabelaEmpresa = $('#tabelaEmpresa').DataTable().row(row).data();


    console.log(tabelaEmpresa);

    $("#ModalEditEmpresa").on("show.bs.modal", function () { 
        $('#nome_edit').val(tabelaEmpresa.nome_cliente_primario);
        $('#edit_cnpj').val(tabelaEmpresa.cnpj_cliente_primario);
        $('#edit_email_cliente_primario').val(tabelaEmpresa.email_cliente_primario);
        $('#edit_telefone').val(tabelaEmpresa.telefone_cliente_primario);
        $('#edit_celular').val(tabelaEmpresa.celular_cliente_primario);
        $('#edit_cep').val(tabelaEmpresa.cep_cliente_primario);
        $('#edit_endereco').val(tabelaEmpresa.logradouro_cliente_primario);
        $('#edit_numero').val(tabelaEmpresa.numero_cliente_primario);
        $('#edit_cidade').val(tabelaEmpresa.cidade_cliente_primario);
        $('#edit_estado').val(tabelaEmpresa.estado_cliente_primario);
        $('#id_cliente_primario').val(tabelaEmpresa.id_cliente_primario);

    });



    new bootstrap.Modal(document.getElementById('ModalEditEmpresa')).show();


});

$("#ModalEditEmpresa").on("hidden.bs.modal", function () { 
    $('#nome_edit').val('');
    $('#id_cliente_primario').val('');
});


$('.btn_edit_empresa').click(function () {

    var formData = $('.form_edit_empresa').serializeArray();
    var jsonData = {};
    var id = $("#id_cliente_primario").val();

    $(formData).each(function (index, obj) {
        jsonData[obj.name] = obj.value;
    });

    jsonData['id'] = id;

    const Toast =   Swal.mixin({
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
        method: 'post',
        url: '/admin/empresa/edit_empresa',
        contentType: 'application/json',
        data: JSON.stringify(jsonData),
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            if (data.status == true) {

                $('#tabelaEmpresa').DataTable().ajax.reload();



                Toast.fire({
                    icon: "success",
                    title: data.message
                });

                $('#ModalEditEmpresa').modal('hide');

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
                title: "Erro editar empresa"
            });
        },
        complete: function () {

        }
    });
});
