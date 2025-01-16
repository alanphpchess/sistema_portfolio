$('#tabelaTags tbody').on('click', '.btn-editar-tags', function () {

    var row = $(this).closest('tr');
    var tabelaTags = $('#tabelaTags').DataTable().row(row).data();

    var id = tabelaTags.id;

    $("#ModalEditTags").on("show.bs.modal", function () {
        $('#nome_edit').val(tabelaTags.titulo);
        $('#id_tags_edit').val(tabelaTags.id);
        $('#cor_edit').val(tabelaTags.color_original);

    });
    new bootstrap.Modal(document.getElementById('ModalEditTags')).show();


});

$("#ModalEditTags").on("hidden.bs.modal", function () {
    $('#nome_edit').val('');
    $('#id_tags_edit').val('');
});


$('.btn_edit_tags').click(function () {

    var formData = $('.form_edit_tags').serializeArray();
    var jsonData = {};
    var id = $("#id_tags_edit").val();

    $(formData).each(function (index, obj) {
        jsonData[obj.name] = obj.value;
    });

    jsonData['id'] = id;

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
        method: 'post',
        url: '/admin/tags/edit_tags',
        contentType: 'application/json',
        data: JSON.stringify(jsonData),
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            if (data.tags == true) {

                $('#tabelaTags').DataTable().ajax.reload();



                Toast.fire({
                    icon: "success",
                    title: data.message
                });

                $('#ModalEditTags').modal('hide');

            } else {

                Toast.fire({
                    icon: "error",
                    title: data.message
                });

            }
        },
        error: function (xhr, tags, error) {

            Toast.fire({
                icon: "error",
                title: "Erro para editar tag"
            });
        },
        complete: function () {

        }
    });
});
