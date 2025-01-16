$('.excluir_tag').click(function() {

    id_tag_cliente = $(this).data('target');

    Swal.fire({
        text: 'Deseja excluir essa tag ?',
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
                url: '/admin/clientes/excluir_tag',
                data: {
                    id_tag_cliente: id_tag_cliente
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