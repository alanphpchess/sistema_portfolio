

$('#tabelaRoleta tbody').on('click', '.btn-excluir-roleta', function () {

    var row = $(this).closest('tr');
    var tabelaRoleta = $('#tabelaRoleta').DataTable().row(row).data();

    var id = tabelaRoleta.id;

    Swal.fire({
        text: 'Deseja excluir pasta ' + tabelaRoleta.nome,
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
                url: 'roleta/excluir_roleta',
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

                        $('#tabelaRoleta').DataTable().ajax.reload();
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
        }

    });



});