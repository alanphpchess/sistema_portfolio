$('.link_excluir_comentario').click(function () {

    id_contato = $(this).closest('.accordion-body').find('[data-target]').data('target');
    
    Swal.fire({
        text: 'Deseja excluir essa comentário ?',
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
                url: '/admin/clientes/excluir_contato',
                data: {
                    id_contato: id_contato
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