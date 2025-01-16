$('#gerar_pdf').click(function () {

    $id_cliente = $('#cliente_id').text();

    window.location.replace("clientes/pdf/"+ $id_cliente);

});