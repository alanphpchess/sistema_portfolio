
$(document).ready(function () {

    $.fn.dataTable.ext.errMode = 'none';
    let tabelaConvite = $('#tabelaConvite').DataTable({
        "sDom": 'rtp',
        "processing": true,
        "serverSide": true,
        "sScrollX": "100%",
        "ajax": {
            'url': "/admin/convite/datatable_convite",
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
                data: 'data',
                className: "text-center"
            },
            {
                data: 'email',
                className: "text-center"
            },
            {
                data: 'id_usuario_convidado',
                className: "text-center"
            },
            {
                data: 'status',
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
        tabelaConvite.search(this.value).draw();
    });

    $('.check-all_database').click(function () {
        if ($(this).is(':checked')) {
            tabelaConvite.rows().select();
        } else {
            tabelaConvite.rows().deselect();
        }
    });

});  
