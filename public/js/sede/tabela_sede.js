
$(document).ready(function () {

    // $.fn.dataTable.ext.errMode = 'none';
    let tabelaSede = $('#tabelaSede').DataTable({
        "sDom": 'rtp',
        "processing": true,
        "serverSide": true,
        "sScrollX": "100%",
        "ajax": {
            'url': "/admin/sede/datatable_sede",
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
                data: 'id_sede',
                className: "text-center"
            },
            {
                data: 'nome_sede',
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
        tabelaSede.search(this.value).draw();
    });

    $('.check-all_database').click(function () {
        if ($(this).is(':checked')) {
            tabelaSede.rows().select();
        } else {
            tabelaSede.rows().deselect();
        }
    });

});  
