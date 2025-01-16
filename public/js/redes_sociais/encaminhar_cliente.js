$('#tabelaRedesSociais tbody').on('click', '.btn-encaminhar-cliente', function () {
    var row = $(this).closest('tr');
    var tabelaRedesSociais = $('#tabelaRedesSociais').DataTable().row(row).data();


    var id = tabelaRedesSociais.id;

    Swal.fire({
        text: 'Deseja encaminhar para o atendimento ao cliente?' ,
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
                method: 'GET',
                url: 'redes_sociais/encaminhar_cliente',
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

                        $('#tabelaRedesSociais').DataTable().ajax.reload();
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