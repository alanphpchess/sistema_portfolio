

$('#tabelaGerPasta tbody').on('click', '.btn-emp-excluir-pasta', function () {

    var row = $(this).closest('tr');
    var tabelaGerPasta = $('#tabelaGerPasta').DataTable().row(row).data();

    var id = tabelaGerPasta.id;

    Swal.fire({
        text: 'Deseja excluir pasta ' + tabelaGerPasta.nome,
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
                url: 'excluir_pasta',
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

                        $('#tabelaGerPasta').DataTable().ajax.reload();
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