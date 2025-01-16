$('#atualizar_roleta').click(function () {


    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'get',
        url: '/admin/roleta/atualizar_roleta',
        contentType: 'application/json',
        data: $('.form_editar_roleta').serialize(),
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {

            if(data.status == true){
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
  
                Toast.fire({
                  icon: "success",
                  title: data.message
                });

                $('#tabelaRoleta').DataTable().ajax.reload();
  
            }

        },
        error: function (xhr, status, error) {


        },
        complete: function () {

        }
    });


});
