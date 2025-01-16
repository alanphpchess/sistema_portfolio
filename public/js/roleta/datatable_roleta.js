
$(document).ready(function () {
    DataTable.defaults.responsive = true;
    var baseURL = window.location.origin;

    let tabelaRoleta = $('#tabelaRoleta').DataTable({
        "sDom": 'rtp',
        "processing": true,
        "serverSide": true,
        "sScrollX": "100%",

        "ajax": {
            'url': baseURL + "/admin/roleta/datatable_roleta",
            'type': 'GET',
            'data': {

            }
        },
        columns: [
            {
                data: "id",
            }, {
                data: 'nome'
            },
            {
                data: 'empreendimento',
                className: "text-center"
            },
            {
                data: 'sede'
            },
            {
                data: 'origem',
                className: "text-center"

            },
            {
                data: 'dt_criacao'
            },

            {
                data: 'prazo',
                className: "text-center"

            },


            { data: 'action' }
        ],
        columnDefs: [

        ],

    });

    $('#search-input').on('keyup', function () {
        tabelaRoleta.search(this.value).draw();
    });



});  
