
$(document).ready(function () {
    DataTable.defaults.responsive = true;
    var baseURL = window.location.origin;

    let tabelaEmpreendimento = $('#tabelaEmpreendimento').DataTable({
        "sDom": 'rtp',
        "processing": true,
        "serverSide": true,
        "sScrollX": "100%",

        "ajax": {
            'url': baseURL + "/admin/empreendimentos/datatable_empreendimentos",
            'type': 'GET',
            'data': {

            }
        },
        columns: [{
            data: 'id_empreendimento'
        },
        {
            data: 'img_principal',
            className: "text-center"
        },
        {
            data: 'sedes'
        },
        {
            data: 'nome_empreendimento'
        },
        {
            data: 'numeros_imgs',
            className: "text-center"

        },
        {
            data: 'arquivos',
            className: "text-center"

        },
        {
            data: 'endereco'
        },
        {
            data: "cidade_empreendimento",
        },
        {
            data: 'estado_empreendimento'
        },
        {
            data: 'cep'
        },
        { data: 'action' }
        ],
        columnDefs: [

        ],

    });

    $('#search-input').on('keyup', function() {
        tabelaEmpreendimento.search(this.value).draw();
    });



});  
