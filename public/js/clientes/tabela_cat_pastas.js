$(document).ready(function () {
    DataTable.defaults.responsive = true;
    var baseURL = window.location.origin;

    // xxx Obter o id através da url
    var url = window.location.href;
    var partesDaUrl = url.split('/');
    var id = partesDaUrl[partesDaUrl.length - 1];

    let tabelaGerPasta = $('#tabelaGerPasta').DataTable({
        "sDom": 'rtp',
        "processing": true,
        "serverSide": true,

        "ajax": {
            'url': baseURL + "/admin/clientes/datatable_cli_ger_pastas",
            'type': 'GET',
            'data': function (data) {
                data.id = id
            }
        },
        columns: [{
            data: 'id'
        },
        {
            data: 'url',
        },
        {
            data: 'arquivos',
        },
        {
            data: 'nome',
        },
        {
            data: 'descricao',
        },
        {
            data: 'action',
            className: 'text-center'
        }
        ],
        columnDefs: [

        ],

    });

    $('#search-emp-ger-pasta').on('keyup', function () {
        tabelaGerPasta.search(this.value).draw();
    });



});  
