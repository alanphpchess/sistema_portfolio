$(document).ready(function () {
    $('#btn_atualizar_perfil').click(function () {

        var formData = new FormData($('.EditarPerfilForm')[0]);

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
            method: 'POST',
            url: '/admin/perfil/atualizar',
            data: formData,
            processData: false,  // Não processar os dados
            contentType: false,  // Não definir o tipo de conteúdo
            beforeSend: function () {
            },
            success: function (data) {
                if (data.status == true) {

                    location.reload()


                } else {

                    if (data.errors.nome) {
                        Toast.fire({
                            icon: "error",
                            title: data.errors.nome[0]
                        });
                    }

                    if (data.errors.telefone) {
                        Toast.fire({
                            icon: "error",
                            title: data.errors.telefone[0]
                        });
                    }

                    if (data.errors.foto_perfil) {

                        Toast.fire({
                            icon: "error",
                            title: data.errors.foto_perfil[0]
                        });
                    }

                }
            },
            error: function (xhr, status, error) {

            },
            complete: function () {
            }
        });
    });

});
