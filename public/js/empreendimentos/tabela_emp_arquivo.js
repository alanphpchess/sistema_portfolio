$(document).ready(function () {
    DataTable.defaults.responsive = true;
    var baseURL = window.location.origin;

    // xxx Obter o id através da url
    var url = window.location.href;
    var partesDaUrl = url.split('/');
    var id = partesDaUrl[partesDaUrl.length - 1];


    let tabelaEmpArquivo = $('#tabelaEmpArquivo').DataTable({
        "sDom": 'rtp',
        "processing": true,
        "serverSide": true,

        "ajax": {
            'url': baseURL + "/admin/empreendimentos/pastas/arquivos/datatable_emp_arquivos",
            'type': 'GET',
            'data': function (data) {
                data.id = id
            }
        },
        columns: [{
            data: 'id'
        },
        {
            data: 'nome',
        },
        {
            data: 'arquivos',
        },
        {
            data: 'action',
            className: 'text-center'
        }
        ],
        columnDefs: [

        ],

    });

    $('#search-emp-arquivo').on('keyup', function () {
        tabelaEmpArquivo.search(this.value).draw();
    });



});  
