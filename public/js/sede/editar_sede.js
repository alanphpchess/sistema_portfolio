$('#tabelaSede tbody').on('click', '.btn-editar-sede', function () {

    var row = $(this).closest('tr');
    var tabelaSede = $('#tabelaSede').DataTable().row(row).data();



    $("#ModalEditSede").on("show.bs.modal", function () { 
        $('#nome_edit').val(tabelaSede.nome_sede);
        $('#id_sede_edit').val(tabelaSede.id_sede);
        $('#cnpj').val(tabelaSede.cnpj_sede);
        $('#cep').val(tabelaSede.cep_sede);
        $('#endereco').val(tabelaSede.logradouro_sede);
        $('#numero').val(tabelaSede.numero_sede);
        $('#cidade').val(tabelaSede.cidade_sede);
        $('.estado').val(tabelaSede.estado_sede).text(tabelaSede.estado_sede);
        $('#telefone').val(tabelaSede.telefone_sede);
        $('#celular').val(tabelaSede.celular_sede);
    });



    new bootstrap.Modal(document.getElementById('ModalEditSede')).show();


});

$("#ModalEditSede").on("hidden.bs.modal", function () { 
    $('#nome_edit').val('');
    $('#id_sede_edit').val('');
});


$('.btn_edit_sede').click(function () {

    var formData = $('.form_edit_sede').serializeArray();
    var jsonData = {};
    var id = $("#id_sede_edit").val();

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
        url: '/admin/sede/edit_sede',
        contentType: 'application/json',
        data: JSON.stringify(jsonData),
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            if (data.status == true) {

                $('#tabelaSede').DataTable().ajax.reload();



                Toast.fire({
                    icon: "success",
                    title: data.message
                });

                $('#ModalEditSede').modal('hide');

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
                title: "Erro editar sede"
            });
        },
        complete: function () {

        }
    });
});
