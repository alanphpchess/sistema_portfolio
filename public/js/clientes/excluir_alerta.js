
$('#link_excluir_alerta').click(function () {

    var id_alerta = $(this).data('target');

    Swal.fire({
        text: 'Deseja excluir esse alerta ?',
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
        confirmButtonColor: '#1cbb8c',
        cancelButtonColor: '#ff3d60'
    }).then((result) => {
        if (result.isConfirmed) {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $.ajax({
                method: 'DELETE',
                url: '/admin/clientes/excluir_alerta',
                data: {
                    id_alerta: id_alerta
                },
                beforeSend: function () {
                },
                success: function (data) {

                    if (data.status == true) {
                        window.location.reload();
                    }

                },
                error: function () {
                },
                complete: function () {
                }
            });
        }

    });

});