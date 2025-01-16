

$('#tabelaGerPasta tbody').on('click', '.btn-emp-editar-pasta', function () {

    var row = $(this).closest('tr');
    var tabelaGerPasta = $('#tabelaGerPasta').DataTable().row(row).data();

    var id = tabelaGerPasta.id;

    $("#ModalEditPasta").on("show.bs.modal", function () { 
        $('#nome_edit').val(tabelaGerPasta.nome);
        $('#id_pasta_edit').val(tabelaGerPasta.id);
        $('#descricao_edit').val(tabelaGerPasta.descricao);
        $('#id_cliente_edit').val(tabelaGerPasta.id_cliente);
    });
    new bootstrap.Modal(document.getElementById('ModalEditPasta')).show();


});

$("#ModalEditPasta").on("hidden.bs.modal", function () { 
    $('#nome_edit').val('');
    $('#id_pasta_edit').val('');
    $('#descricao_edit').val('');
});


$('.btn_edit_pasta').click(function () {

    var formData = $('.form_edit_pasta').serializeArray();
    var jsonData = {};
    var id = $("#id_pasta_edit").val();
    var id_cliente= $("#id_cliente_edit").val();

    $(formData).each(function (index, obj) {
        jsonData[obj.name] = obj.value;
    });

    jsonData['id'] = id;
    jsonData['id_cliente'] = id_cliente;

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
        url: '/admin/clientes/pastas/gerenciamento/edit_pasta',
        contentType: 'application/json',
        data: JSON.stringify(jsonData),
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            if (data.status == true) {

                $('#tabelaGerPasta').DataTable().ajax.reload();



                Toast.fire({
                    icon: "success",
                    title: data.message
                });

                $('#ModalEditPasta').modal('hide');

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
                title: "Erro ao editar a pasta"
            });
        },
        complete: function () {

        }
    });
});
