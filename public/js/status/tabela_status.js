
$(document).ready(function () {

    let tabelaStatus = $('#tabelaStatus').DataTable({
        "sDom": 'rtp',
        "processing": true,
        "serverSide": true,
        "sScrollX": "100%",
        "ajax": {
            'url': "/admin/status/datatable_status",
            'type': 'GET',
            'data': {

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
                data: 'id_status',
                className: "text-center"
            },
            {
                data: 'titulo_status',
                className: "text-center"
            },
            {
                data: 'posicao_status',
                className: "text-center"
            },
            {
                data: 'cor',
                className: "text-center"
            },
            {
                data: 'action',
                className: "text-center"
            },
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

    $('#search-input').on('keyup', function () {
        tabelaStatus.search(this.value).draw();
    });

    $('.check-all_database').click(function () {
        if ($(this).is(':checked')) {
            tabelaStatus.rows().select();
        } else {
            tabelaStatus.rows().deselect();
        }
    });

});  
