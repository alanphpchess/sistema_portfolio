

$('#tabelaEmails tbody').on('click', '.btn-excluir-emails', function () {

    var row = $(this).closest('tr');
    var tabelaEmails = $('#tabelaEmails').DataTable().row(row).data();

    var id = tabelaEmails.id;

    Swal.fire({
        text: 'Deseja excluir o e-mail de ' + tabelaEmails.nome,
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
                url: 'emails/excluir',
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

                        $('#tabelaEmails').DataTable().ajax.reload();
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