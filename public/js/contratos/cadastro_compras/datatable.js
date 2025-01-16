
$(document).ready(function () {

    $.fn.dataTable.ext.errMode = 'none';
    let tabela = $('#tabela').DataTable({
        "sDom": 'rtp',
        "processing": true,
        "serverSide": true,
        "sScrollX": "100%",
        "ajax": {
            'url': "/admin/contratos/cadastro_compras/datatable",
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
                data: 'nome', //data_registro
                className: "text-center"
            },
            {
                data: 'nome',
                className: "text-center"
            },
            {
                data: 'nome',
                className: "text-center"
            },
            {
                data: 'nome',
                className: "text-center"
            },
            {
                data: 'nome',
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
        tabela.search(this.value).draw();
    });

    $('.check-all_database').click(function () {
        if ($(this).is(':checked')) {
            tabela.rows().select();
        } else {
            tabela.rows().deselect();
        }
    });

});  
