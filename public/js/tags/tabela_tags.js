
$(document).ready(function () {

    let tabelaTags = $('#tabelaTags').DataTable({
        "sDom": 'rtp',
        "processing": true,
        "serverSide": true,
        "sScrollX": "100%",
        "ajax": {
            'url': "/admin/tags/datatable_tags",
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
                data: 'id',
                className: "text-center"
            },
            {
                data: 'titulo',
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
        tabelaTags.search(this.value).draw();
    });

    $('.check-all_database').click(function () {
        if ($(this).is(':checked')) {
            tabelaTags.rows().select();
        } else {
            tabelaTags.rows().deselect();
        }
    });

});  
