$('#link_editar_cliente').click(function(){
    $("#ModalEditarCliente").on("show.bs.modal", function () { 

        // / VALORES DO EDITAR CLIENTE
        edit_id_cli = $('.edit_id_cli').text(); 
        edit_nome_cli = $('.edit_nome_cli').text(); 
        edit_emp_cli = $('.edit_emp_cli').text(); 
        edit_telefone_cli = $('.edit_telefone_cli').text();
        edit_celular_cli = $('.edit_celular_cli').text();
        edit_email1_cli = $('.edit_email1_cli').text();
        edit_email2_cli = $('.edit_email2_cli').text();
        edit_fgts_cli = $('.edit_fgts_cli').text();
        edit_cep_cli = $('.edit_cep_cli').text();
        edit_endereco_cli = $('.edit_endereco_cli').text();
        edit_numero_cli = $('.edit_numero_cli').text();
        edit_bairro_cli = $('.edit_bairro_cli').text();
        edit_cidade_cli = $('.edit_cidade_cli').text();
        edit_estado_cli = $('.edit_estado_cli').text();
        edit_fgts = $('.edit_fgts').text();

        // / INSERIR VALORES NO MODAL CLIENTE
        $('#edit_id').val(edit_id_cli);
        $('#edit_nome').val(edit_nome_cli);
        $('#edit_emp').val(edit_emp_cli);
        $('#edit_telefone').val(edit_telefone_cli);
        $('#edit_celular').val(edit_celular_cli);
        $('#edit_email_1').val(edit_email1_cli);
        $('#edit_email_2').val(edit_email2_cli);
        $('#edit_fgts').val(edit_fgts_cli);
        $('#edit_cep').val(edit_cep_cli);
        $('#edit_endereco').val(edit_endereco_cli);
        $('#edit_numero').val(edit_numero_cli);
        $('#edit_bairro').val(edit_bairro_cli);
        $('#edit_cidade').val(edit_cidade_cli);
        $('#edit_estado').val(edit_estado_cli);
        
        $('#edit_fgts').prepend('<option value="'+ edit_fgts +'">'+ edit_fgts +'</option>');

    });
    new bootstrap.Modal(document.getElementById('ModalEditarCliente')).show();
});


$('#salvar_editar_cliente').click(function(e) {

    var formData = $('.form_edit_cli').serializeArray();
    var jsonData = {};
    var id_cliente = $("#edit_id").val();

    $(formData).each(function (index, obj) {
        jsonData[obj.name] = obj.value;
    });

    jsonData['id_cliente'] = id_cliente;

    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'post',
        url: '/admin/clientes/atualizar',
        contentType: 'application/json',
        data: JSON.stringify(jsonData),
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {
            if (data.status == true) {

                window.location.reload();
              
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
                title: "Erro ao editar cliente"
            });
        },
        complete: function () {
            // Adicione aqui qualquer código que precise ser executado após a conclusão da solicitação AJAX
        }
    });
});