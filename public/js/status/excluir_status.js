

$('#tabelaStatus tbody').on('click', '.btn-excluir-status', function () {

    var row = $(this).closest('tr');
    var tabelaStatus = $('#tabelaStatus').DataTable().row(row).data();

    var id = tabelaStatus.id_status;

    Swal.fire({
        text: 'Deseja excluir status ' + tabelaStatus.titulo_status,
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
                url: 'status/excluir',
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

                        $('#tabelaStatus').DataTable().ajax.reload();
                        Toast.fire({
                            icon: "success",
                            title: data.message
                        });

                        $('#ModalADDStatus').modal('hide');

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





