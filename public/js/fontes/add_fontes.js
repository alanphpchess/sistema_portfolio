$('.btn_add_fontes').click(function () {

    var formData = $('.form_add_fontes').serializeArray();
    var jsonData = {};

    $(formData).each(function (index, obj) {
        jsonData[obj.name] = obj.value;
    });


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
        url: '/admin/fontes/add_fontes',
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

                $('#ModalADDFontes').modal('hide');

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
                title: "Erro para editar"
            });
        },
        complete: function () {

        }
    });


});
