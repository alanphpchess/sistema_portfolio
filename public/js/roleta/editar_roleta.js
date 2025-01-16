

$('#tabelaRoleta tbody').on('click', '.btn-editar-roleta', function () {
    $.fn.dataTable.ext.errMode = 'none';
    var row = $(this).closest('tr');
    var tabelaRoleta = $('#tabelaRoleta').DataTable().row(row).data();


    var id = tabelaRoleta.id;

    $('#id_roleta').val(tabelaRoleta.id);

    $("#ModalEditarRoleta").on("show.bs.modal", function () {


        // // / VALORES DO EDITAR CLIENTE
        $('#nome_roleta').val(tabelaRoleta.nome);

        // Converter para o formato ISO 8601
        var partes = tabelaRoleta.prazo.split(' ');
        var data = partes[0];
        var hora = partes[1];
        var isoFormato = data.replace(/(\d{2})-(\d{2})-(\d{4})/, '$3-$2-$1') + 'T' + hora;

        // Definir o valor do input usando jQuery
        $('#data_roleta').val(isoFormato);


        $('#select_empreendimento_titulo').val(tabelaRoleta.id_empreendimento).text(tabelaRoleta.empreendimento);
        $('#select_sede_titulo').val(tabelaRoleta.id_sede).text(tabelaRoleta.sede);

        var baseURL = window.location.origin;

        let tabelaRoletaUsuarios = $('#tabelaRoletaUsuarios').DataTable({
            "sDom": 'rtp',
            "processing": true,
            "serverSide": true,
            "sScrollX": "100%",

            "ajax": {
                'url': baseURL + "/admin/roleta/datatable_roleta_usuarios",
                'type': 'GET',
                'data': {
                    id_usuario: id,
                    id_roleta:  $('#id_roleta').val()
                }
            },
            columns: [
                {
                    data: 'nome_usuario'
                },
                {
                    data: 'email_usuario',
                    className: "text-center"
                },
                {
                    data: 'parte_roleta',
                    className: "text-center"
                },
                {
                    data: 'tempo',
                    className: "text-center"
                },
                {
                    data: 'ordem',
                    className: "text-center"
                }
            ],
            columnDefs: [

            ],

        });
        $('#tabelaRoletaUsuarios').DataTable().ajax.reload();

        $('#search-input').on('keyup', function () {
            tabelaRoletaUsuarios.search(this.value).draw();
        });
    });
    new bootstrap.Modal(document.getElementById('ModalEditarRoleta')).show();



});




$('#tabelaRoletaUsuarios').on('change', '#faz_parte_roleta', function () {

    var selectedValue = $(this).val(); // Obtém o valor selecionado
    var row = $(this).closest('tr');
    var tabelaRoleta = $('#tabelaRoletaUsuarios').DataTable().row(row).data();

    console.log(tabelaRoleta.id);

    $.ajax({
        method: 'GET', // Ou outro método HTTP adequado
        url: '/admin/roleta/usuario_parte_roleta', // URL do seu backend que irá processar o valor selecionado
        data: {
            faz_parte_roleta: selectedValue,
            id_usuario: tabelaRoleta.id,
            id_roleta: $('#id_roleta').val()

        },
        success: function (response) {
            // Trata o sucesso da requisição

            $('#tabelaRoletaUsuarios').DataTable().ajax.reload();
        },
        error: function (xhr, status, error) {
            // Trata erros na requisição
            console.error('Erro ao enviar valor:', error);
        }
    });
});


$('#tabelaRoletaUsuarios').on('change', '#tempo', function () {

    var selectedValue = $(this).val(); // Obtém o valor selecionado
    var row = $(this).closest('tr');
    var tabelaRoleta = $('#tabelaRoletaUsuarios').DataTable().row(row).data();

    // console.log(selectedValue, row,  tabelaRoleta);

    console.log(tabelaRoleta.id, tabelaRoleta.name);


    // Exemplo de envio via AJAX para o backend
    $.ajax({
        method: 'GET', // Ou outro método HTTP adequado
        url: '/admin/roleta/adicionar_tempo', // URL do seu backend que irá processar o valor selecionado
        data: {
            tempo: selectedValue,
            id_usuario: tabelaRoleta.id,
            id_roleta: $('#id_roleta').val()

        },
        success: function (response) {
            // Trata o sucesso da requisição
            console.log('Valor enviado com sucesso.');
            $('#tabelaRoletaUsuarios').DataTable().ajax.reload();
            
        },
        error: function (xhr, status, error) {
            // Trata erros na requisição
            console.error('Erro ao enviar valor:', error);
        }
    });
});



$('#tabelaRoletaUsuarios').on('change', '#ordem', function () {

    var selectedValue = $(this).val(); // Obtém o valor selecionado
    var row = $(this).closest('tr');
    var tabelaRoleta = $('#tabelaRoletaUsuarios').DataTable().row(row).data();


    $.ajax({
        method: 'GET', 
        url: '/admin/roleta/atualizar_ordem', 
        data: {
            ordem: selectedValue,
            id_usuario: tabelaRoleta.id,
            id_roleta: $('#id_roleta').val(),
            id_roleta_usuario: tabelaRoleta.id

        },
        success: function (response) {

            $('#tabelaRoletaUsuarios').DataTable().ajax.reload();
            
        },
        error: function (xhr, status, error) {

            console.error('Erro ao enviar valor:', error);
        }
    });
});
