$('.btn_add_roleta').click(function(){


    $("#ModalAddRoleta").on("show.bs.modal", function () {

        var baseURL = window.location.origin;
        let tabelaRoletaUsuarios = $('#tabelaRoletaUsuariosAdd').DataTable({
            "sDom": 'rtp',
            "processing": true,
            "serverSide": true,
            "sScrollX": "100%",

            "ajax": {
                'url': baseURL + "/admin/roleta/datatable_add_roleta",
                'type': 'GET',
                'data': {
                    // id_usuario: id
                }
            },
            columns: [
                {
                    data: 'name'
                },
                {
                    data: 'email',
                    className: "text-center"
                },
                {
                    data: 'parte_roleta',
                    className: "text-center"
                },
                {
                    data: 'tempo',
                    className: "text-center"
                }
            ],
            columnDefs: [

            ],

        });

        $('#search-input').on('keyup', function () {
            tabelaRoletaUsuarios.search(this.value).draw();
        });

    });

    new bootstrap.Modal(document.getElementById('ModalAddRoleta')).show();
});


$('#btn_criar_roleta').click(function(){

    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'get',
        url: '/admin/roleta/criar_roleta',
        contentType: 'application/json',
        data: $('.form_criar_roleta').serialize(),
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {

            if(data.status == true){
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
        error: function (xhr, status, error) {


        },
        complete: function () {

        }
    });


});