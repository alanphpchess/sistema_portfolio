

$('#tabelaFontes tbody').on('click', '.btn-excluir-fontes', function () {

    var row = $(this).closest('tr');
    var tabelaFontes = $('#tabelaFontes').DataTable().row(row).data();

    var id = tabelaFontes.id_fonte;

    Swal.fire({
        text: 'Deseja excluir fontes ' + tabelaFontes.titulo_fonte,
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
                url: 'fontes/excluir',
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

                        $('#tabelaFontes').DataTable().ajax.reload();
                        Toast.fire({
                            icon: "success",
                            title: data.message
                        });

                        $('#ModalADDFontes').modal('hide');

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





