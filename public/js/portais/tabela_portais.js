
$(document).ready(function () {
    DataTable.defaults.responsive = true;
    var baseURL = window.location.origin;

    let tabelaPortais= $('#tabelaPortais').DataTable({
        "sDom": 'rtp',
        "processing": true,
        "serverSide": true,
        "sScrollX": "100%",

        "ajax": {
            'url': baseURL + "/admin/portais/datatable_portais",
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
        tabelaPortais.search(this.value).draw();
    });



});  


$(document).ready(function () {
    // Função para iniciar a contagem regressiva
    function startCountdown() {
        $('.countdown').each(function () {
            var $this = $(this);
            var initialTime = parseInt($this.data('time'));

            function updateCountdown() {
                if (initialTime > 0) {
                    $this.text(initialTime);
                    initialTime--;
                    setTimeout(updateCountdown, 1000); // Atualiza a cada segundo (1000 ms)
                } else {
                    $this.text('Contagem encerrada');
                }
            }

            // Inicia a contagem regressiva para este elemento
            updateCountdown();
        });
    }

    // Chama a função para iniciar a contagem regressiva quando o documento estiver pronto
    startCountdown();
});


