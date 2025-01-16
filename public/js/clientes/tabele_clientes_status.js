
$(document).ready(function () {

    DataTable.defaults.responsive = true;
    let tabelaClientesStatus = $('#tabelaClientesStatus').DataTable({
        "sDom": 'rtp',
        "processing": true,
        "serverSide": true,
        "sScrollX": "100%",
        "ajax": {
            'url': "/admin/clientes/datatable_clientes_status",
            'type': 'GET',
            'data': {

            },
            'dataSrc': function(json) {

                $('.text_total_cliente').text(json.recordsTotal);

                return json.data; 
            }
        },
        columns: [
            {
                data: 'id',
                className: 'select-checkbox',
            },
            {
                data: 'data_criacao',
                className: "text-center"
            },

        ],
        "footerCallback": function(row, data, start, end, display) {
            // var api = this.api();
            // var totalCount = api.rows().count();
        },
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
