$('#tabelaRoleta tbody').on('click', '.btn-visualizar', function () {

    var row = $(this).closest('tr');
    var tabelaPortais = $('#tabelaRoleta').DataTable().row(row).data();


    var id = tabelaPortais.id;





});