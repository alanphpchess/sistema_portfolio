

$('#tabelaTags tbody').on('click', '.btn-excluir-tags', function () {

    var row = $(this).closest('tr');
    var tabelaTags = $('#tabelaTags').DataTable().row(row).data();

    var id = tabelaTags.id;

    Swal.fire({
        text: 'Deseja excluir tags ' + tabelaTags.titulo,
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
                url: 'tags/excluir',
                data: {
                    id: id
                },
                beforeSend: function () {

                },
                success: function (data) {

                    if (data.tags == true) {
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

                        $('#tabelaTags').DataTable().ajax.reload();
                        Toast.fire({
                            icon: "success",
                            title: data.message
                        });

                        $('#ModalADDTags').modal('hide');

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





