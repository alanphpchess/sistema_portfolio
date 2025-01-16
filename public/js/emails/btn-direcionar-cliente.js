$('#tabelaEmails tbody').on('click', '.btn-direcionar-cliente', function () {
    var row = $(this).closest('tr');
    var tabelaEmails = $('#tabelaEmails').DataTable().row(row).data();
    var id = tabelaEmails.id;


    $("#ModalEncaminharUsuario").on("show.bs.modal", function () {


        $('#encaminhar_portal_id').val(tabelaEmails.id);


    });

    new bootstrap.Modal(document.getElementById('ModalEncaminharUsuario')).show();


});



$('#btn_encaminhar_cliente').click(function (){

    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'get',
        url: 'emails/encaminhar_usuario_cliente',
        contentType: 'application/json',
        data: $('#form_enc_usuario').serialize(),
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            
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

            if (data.status == true) {

                Toast.fire({
                    icon: "success",
                    title: data.message
                });

                $('#tabelaEmails').DataTable().ajax.reload();
              
            } else {

                Toast.fire({
                    icon: "error",
                    title: data.message
                });

            }
        },
        error: function (xhr, status, error) {

            Toast.fire({
                icon: "error",
                title: "Erro ao direcionar cliente"
            });
        },
        complete: function () {
       
        }
    });

});

