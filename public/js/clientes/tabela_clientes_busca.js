
$(document).ready(function () {

    var urlParams = window.location.search;

    var params = new URLSearchParams(urlParams);

    // Acesse os parâmetros individualmente usando o método get()

    DataTable.defaults.responsive = true;
    let tabelaClientes = $('#tabelaClientes').DataTable({
        "sDom": 'rtp',
        "processing": true,
        "serverSide": true,
        "sScrollX": "100%",
        "ajax": {
            'url': "/admin/clientes/datatable_clientes_busca",
            'type': 'GET',
            'data': function (data) {
                data.data_inicio =  params.get('data_inicio'),
                data.data_fim = params.get('data_fim'),
                data.opcao_pasta = params.get('opcao_pasta')
            }
        },
        columns: [
            {
                data: null,
                orderable: false,
                className: 'select-checkbox',
                defaultContent: ""
            },
            {
                data: 'data_criacao',
                className: "text-center"
            },
            {
                data: 'data_atualizacao',
                className: "text-center"
            },
            {
                data: 'nome',//status
                className: "text-center"
            },
            {
                data: 'nome',
                className: "text-center"
            },
            {
                data: 'corretor',
                className: "text-center"
            },
            {
                data: 'empreendimento',
                className: "text-center"
            },
            {
                data: 'nome' //fontes
            },
            {
                data: 'nome' //telefone

            },
            {
                data: 'tags'
            },
            {
                data: 'arquivos',
                className: "text-center"

            },
            {
                data: 'email1',
                className: "text-center"
            },
            { data: 'action' }
        ],
        columnDefs: [{
            targets: 0,
            orderable: false,
            className: 'select-checkbox'
        }],
        select: {
            style: 'multi',
            selector: 'td:first-child',
        },
        order: [
            [1, 'desc']
        ]
    }
    );

    $('#search-input').on('keyup', function() {
        tabelaEmpreendimento.search(this.value).draw();
    });
    
    $('.check-all_database').click(function () {
        if ($(this).is(':checked')) {
            tabelaClientes.rows().select();
        } else {
            tabelaClientes.rows().deselect();
        }
    });



});  
