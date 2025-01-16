

$(document).ready(function() {
    
    $('#clientes').on('click', '.form-check-input', function() {
        var checkboxId = $(this).attr('id'); 

        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/permissao/atualizar',
            method: 'POST',
            data: {
                funcionalidade: checkboxId,
                ativo: $(this).prop('checked'),
                id_usuario: $("#id_usuario") .data('target')
            },
            success: function(response) {
                console.log('Solicitação enviada com sucesso');
            },
            error: function(xhr, status, error) {
                console.error('Erro ao enviar solicitação AJAX');
            }
        });
        
    });

    $('#empreendimento').on('click', '.form-check-input', function() {
        var checkboxId = $(this).attr('id'); 

        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/permissao/atualizar',
            method: 'POST',
            data: {
                funcionalidade: checkboxId,
                ativo: $(this).prop('checked'),
                id_usuario: $("#id_usuario") .data('target')
            },
            success: function(response) {
                console.log('Solicitação enviada com sucesso');
            },
            error: function(xhr, status, error) {
                console.error('Erro ao enviar solicitação AJAX');
            }
        });
        
    });
});