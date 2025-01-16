
$('#tabelaEquipe tbody').on('click', '.btn-excluir-adm', function () {
    var row = $(this).closest('tr');
    var tabelaEquipe = $('#tabelaEquipe').DataTable().row(row).data();

    var id = tabelaEquipe.id;
    var id_usuario = tabelaEquipe.id_usuario;


    Swal.fire({
        text: 'Deseja remover como administrador?',
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
                method: 'POST',
                url: 'equipe/adm/remover',
                data: {
                    id: id,
                    id_usuario: id_usuario
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

                        $('#tabelaEquipe').DataTable().ajax.reload();
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