
$(document).ready(function () {
    DataTable.defaults.responsive = true;
    var baseURL = window.location.origin;
    // DataTable.defaults.responsive = true;
    let tabelaClientes = $('#tabelaClientes').DataTable({
        "sDom": 'rtp',
        "processing": true,
        "serverSide": true,
        "sScrollX": "100%",
        "ajax": {
            'url': baseURL + "/admin/clientes/datatable_clientes",
            'type': 'GET',
            'data': {

            },
        },
        "footerCallback": function (row, data, start, end, display) {

            var total_cliente = tabelaClientes.page.info().recordsDisplay;

            $('.text_total_cliente').text(total_cliente);


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
                data: 'status',
                className: "text-center",
                name: "status_id_status",
            },
            {
                data: 'nome_cliente',
                className: "text-center",
            },
            {
                data: 'corretor',
                className: "text-center",
                name: "usuarios_id_usuario"
            },
            {
                data: 'grupo_sede',
                className: "text-center",
                name: "grupo_sede"
            },
            {
                data: 'grupo_empreendimento',
                className: "text-center",
                name: "id_empreendimento"
            },
            {
                data: 'fontes_id_fonte'
            },
            {
                data: 'telefone1_cliente'

            },
            {
                data: 'tags'
            },
            {
                data: 'email1_cliente',
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

});  
