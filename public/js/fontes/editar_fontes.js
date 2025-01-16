$('#tabelaFontes tbody').on('click', '.btn-editar-fontes', function () {

    var row = $(this).closest('tr');
    var tabelaFontes = $('#tabelaFontes').DataTable().row(row).data();

    var id = tabelaFontes.id_fonte;

    $("#ModalEditFontes").on("show.bs.modal", function () { 
        $('#nome_edit').val(tabelaFontes.nome_fontes);
        $('#id_fontes_edit').val(tabelaFontes.id_fontes);
    });
    new bootstrap.Modal(document.getElementById('ModalEditFontes')).show();


});

$("#ModalEditFontes").on("hidden.bs.modal", function () { 
    $('#nome_edit').val('');
    $('#id_fontes_edit').val('');
});


$('.btn_edit_fontes').click(function () {

    var formData = $('.form_edit_fontes').serializeArray();
    var jsonData = {};
    var id = $("#id_fontes_edit").val();

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
        url: '/admin/fontes/edit_fontes',
        contentType: 'application/json',
        data: JSON.stringify(jsonData),
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            if (data.status == true) {

                $('#tabelaFontes').DataTable().ajax.reload();



                Toast.fire({
                    icon: "success",
                    title: data.message
                });

                $('#ModalEditFontes').modal('hide');

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
                title: "Erro para editar fontes"
            });
        },
        complete: function () {

        }
    });
});
