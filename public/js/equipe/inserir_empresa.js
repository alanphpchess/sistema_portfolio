$('#btn_inserir_empresa').click(function() {

    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'get',
        url: '/admin/equipe/inserir_empresa',
        contentType: 'application/json',
        data: $('#form_add_empresa').serialize(),
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            
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

            if (data.status == true) {

                Toast.fire({
                    icon: "success",
                    title: data.message
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
                title: "Erro para inserir empresa"
            });
        },
        complete: function () {
       
        }
    });

});