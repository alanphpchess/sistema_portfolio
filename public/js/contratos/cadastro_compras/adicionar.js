$('.btn_add_cadastro_compra').click(function () {

    var formData = $('.form_add').serializeArray();
    var jsonData = {};

    $(formData).each(function (index, obj) {
        jsonData[obj.name] = obj.value;
    });


    const Toast =   Swal.mixin({
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


    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'post',
        url: '/admin/contratos/cadastro_compras/inserir',
        contentType: 'application/json',
        data: JSON.stringify(jsonData),
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            if (data.status == true) {

                window.location.href = '/admin/contratos/cadastro_compras';

            } else {

                let errorTable = `
                <div style="max-height: 300px; overflow-y: auto;">
                    <table style="width: 100%; border-collapse: collapse;">
                        <thead>
                            <tr>
                                <th style="border: 1px solid #ddd; padding: 8px;">Campos</th>
                            </tr>
                        </thead>
                        <tbody>`;
            
            data.erros.forEach(function(error) {
                errorTable += `<tr><td style="border: 1px solid #ddd; padding: 8px;">${error}</td></tr>`;
            });
            
            errorTable += `
                        </tbody>
                    </table>
                </div>`;
            
            Swal.fire({
                icon: 'warning',
                title: 'Erro',
                html: errorTable,
                confirmButtonText: 'Ok'
            });
            
            }
        },
        error: function (xhr, status, error) {

            Toast.fire({
                icon: "error",
                title: "Erro para editar"
            });
        },
        complete: function () {

        }
    });


});
