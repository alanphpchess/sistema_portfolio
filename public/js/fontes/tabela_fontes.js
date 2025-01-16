
$(document).ready(function () {

    // $.fn.dataTable.ext.errMode = 'none';
    let tabelaFontes = $('#tabelaFontes').DataTable({
        "sDom": 'rtp',
        "processing": true,
        "serverSide": true,
        "sScrollX": "100%",
        "ajax": {
            'url': "/admin/fontes/datatable_fontes",
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
                data: 'id_fonte',
                className: "text-center"
            },
            {
                data: 'titulo_fonte',
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
        tabelaFontes.search(this.value).draw();
    });

    $('.check-all_database').click(function () {
        if ($(this).is(':checked')) {
            tabelaFontes.rows().select();
        } else {
            tabelaFontes.rows().deselect();
        }
    });

});  
