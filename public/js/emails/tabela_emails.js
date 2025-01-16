
$(document).ready(function () {
    DataTable.defaults.responsive = true;
    var baseURL = window.location.origin;

    let tabelaEmpreendimento = $('#tabelaEmails').DataTable({
        "sDom": 'rtp',
        "processing": true,
        "serverSide": true,
        "sScrollX": "100%",

        "ajax": {
            'url': baseURL + "/admin/emails/datatable_emails",
            'type': 'GET',
            'data': {

            }
        },
        columns: [
            {
                data: "data_registro",
            }, {
                data: 'id'
            },
            {
                data: 'email',
                className: "text-center"
            },
            {
                data: 'usuario',
                className: "text-center"
            },
            {
                data: 'telefone'
            },
            {
                data: 'mensagem',
                className: "text-center"

            },
            {
                data: 'nome_empreendimento'
            },
            { data: 'action' }
        ],
        columnDefs: [

        ],

    });

    $('#search-input').on('keyup', function () {
        tabelaEmpreendimento.search(this.value).draw();
    });



});  
