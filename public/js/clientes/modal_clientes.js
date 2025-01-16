$('#tabelaClientes tbody').on("click", "tr td:not(:first-child):not(:last-child):not(:nth-child(7)):not(:nth-child(9))", function () {

    let data = $('#tabelaClientes').DataTable().row($(this).parent()).data();

    $("#ModalClientes").on("show.bs.modal", function () { 
        $('#cliente_id').text(data.id_cliente);
        $('#cliente_nome').text(data.nome_cliente.replace(/<\/?[^>]+(>|$)/g, ""));
        $('#cliente_empreendimento').text(data.nome_cliente.replace(/<\/?[^>]+(>|$)/g, ""));
        $('#cliente_telefone').html(data.telefone1_cliente);
        $('#cliente_email_1').text(data.email1_cliente.replace(/<\/?[^>]+(>|$)/g, ""));
        $('#cliente_email_2').text(data.email2_cliente.replace(/<\/?[^>]+(>|$)/g, ""));
        $('#cliente_data_criacao').text(data.data_criacao.replace(/<\/?[^>]+(>|$)/g, ""));
        $('#cliente_data_atualizacao').text(data.data_atualizacao.replace(/<\/?[^>]+(>|$)/g, ""));
        $('#cliente_data_lead').text(data.data_lead);
        $('#cliente_cep').text(data.cep_cliente);
        $('#cliente_endereco').text(data.endereco_cliente);
        $('#cliente_numero').text(data.numero_cliente);
        $('#cliente_bairro').text(data.bairro_cliente);
        $('#cliente_cidade').text(data.cidade_cliente);
        $('#cliente_status').text(data.status.replace(/<\/?[^>]+(>|$)/g, ""));
        $('#cliente_tag').html(data.tags);
        $('#cliente_fonte').html(data.fontes_id_fonte);

        $('.link_cliente_editar').attr('href', '/admin/clientes/editar/' + data.id_cliente);


    });

    new bootstrap.Modal(document.getElementById('ModalClientes')).show();

});