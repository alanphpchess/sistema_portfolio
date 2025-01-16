$('.btn_add_pasta').click(function () {

    var formData = $('.form_add_pasta').serializeArray();
    var jsonData = {};
    var id_empreendimento = $("#id_empreendimento").val();

    $(formData).each(function (index, obj) {
        jsonData[obj.name] = obj.value;
    });

    jsonData['id_empreendimento'] = id_empreendimento;

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


    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'post',
        url: '/admin/empreendimentos/pastas/gerenciamento/add_pasta',
        contentType: 'application/json',
        data: JSON.stringify(jsonData),
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            if (data.status == true) {

                $('#tabelaGerPasta').DataTable().ajax.reload();



                Toast.fire({
                    icon: "success",
                    title: data.message
                });

                $('#ModalAddPasta').modal('hide');

                $('#myModal').on('hidden.bs.modal', function () {
                    $(this).find('input, textarea').val('');
                });

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
                title: "Erro ao adicionar a pasta"
            });
        },
        complete: function () {
            // Adicione aqui qualquer código que precise ser executado após a conclusão da solicitação AJAX
        }
    });
});
