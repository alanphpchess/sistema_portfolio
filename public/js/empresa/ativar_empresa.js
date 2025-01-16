

$('#tabelaEmpresa tbody').on('click', '.btn-ativar-empresa', function () {

    var row = $(this).closest('tr');
    var tabelaEmpresa = $('#tabelaEmpresa').DataTable().row(row).data();

    var id = tabelaEmpresa.id_cliente_primario;

    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: 'empresa/ativar',
        data: {
            id: id
        },
        beforeSend: function () {

        },
        success: function (data) {

            if (data.status == true) {
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

                $('#tabelaEmpresa').DataTable().ajax.reload();
                Toast.fire({
                    icon: "success",
                    title: data.message
                });

            }

        },
        error: function () {
        },
        complete: function () {
        }
    });



});





