$('#tabelaStatus tbody').on('click', '.btn-editar-status', function () {

    var row = $(this).closest('tr');
    var tabelaStatus = $('#tabelaStatus').DataTable().row(row).data();

    var id = tabelaStatus.id;

    $("#ModalEditStatus").on("show.bs.modal", function () { 
        $('#nome_edit').val(tabelaStatus.titulo_status);
        $('#id_status_edit').val(tabelaStatus.id_status);
        $('#cor_edit').val(tabelaStatus.color_original);
        $('#ordem_atual').val(tabelaStatus.posicao_status).text(tabelaStatus.posicao_status);

    });
    new bootstrap.Modal(document.getElementById('ModalEditStatus')).show();


});

$("#ModalEditStatus").on("hidden.bs.modal", function () { 
    $('#nome_edit').val('');
    $('#id_status_edit').val('');
});


$('.btn_edit_status').click(function () {

    var formData = $('.form_edit_status').serializeArray();
    var jsonData = {};
    var id = $("#id_status_edit").val();

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
        url: '/admin/status/edit_status',
        contentType: 'application/json',
        data: JSON.stringify(jsonData),
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            if (data.status == true) {

                $('#tabelaStatus').DataTable().ajax.reload();



                Toast.fire({
                    icon: "success",
                    title: data.message
                });

                $('#ModalEditStatus').modal('hide');

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
                title: "Erro para editar!"
            });
        },
        complete: function () {

        }
    });
});
