$('.btn_env_convite').click(function () {

    var formData = $('.form_env_convite').serializeArray();
    var jsonData = {};


    $(formData).each(function (index, obj) {
        jsonData['email'] = obj.value;
    });

    
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
        url: '/admin/convite/enviar_equipe',
        contentType: 'application/json',
        data: JSON.stringify(jsonData),
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            if (data.status == true) {

                Toast.fire({
                    icon: "success",
                    title: data.message
                });

                $('#tabelaConvite').DataTable().ajax.reload();


                $('#ModalConvite').modal('hide');

                $('#myModal').on('hidden.bs.modal', function () {
                    $(this).find('input, textarea').val('');
                });

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
                title: "Erro ao enviar convite"
            });
        },
        complete: function () {
            // Adicione aqui qualquer código que precise ser executado após a conclusão da solicitação AJAX
        }
    });
});
