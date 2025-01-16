

$('#tabelaEmpresa tbody').on('click', '.btn-excluir-empresa', function () {

    var row = $(this).closest('tr');
    var tabelaEmpresa = $('#tabelaEmpresa').DataTable().row(row).data();

    var id = tabelaEmpresa.id_cliente_primario;

    Swal.fire({
        text: 'Deseja excluir empresa ' + tabelaEmpresa.nome_cliente_primario,
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
        confirmButtonColor: '#1cbb8c',
        cancelButtonColor: '#ff3d60'
    }).then((result) => {
        if (result.isConfirmed) {

            Swal.fire({
                text: 'Se você excluir os dados dessa empresa perderá todos os dados do sistema da empresa ' + tabelaEmpresa.nome_cliente_primario + '! Deseja realmente excluir? ',
                showCancelButton: true,
                icon: "warning",
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
                        url: 'empresa/excluir',
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
                }

            });

        }

    });



});





