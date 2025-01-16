

/// GRÁFICO DO STATUS  

const chartx = document.getElementById('ChartTipoImoveis');

if (chartx) {


    var status_titulo = [];
    $('.status_titulo').each(function () {
        var texto = $(this).text().trim();
        status_titulo.push(texto);
    });

    var status_quantidade = [];
    $('.status_quantidade').each(function () {
        var texto = $(this).text().trim();
        status_quantidade.push(texto);
    });

    new Chart(chartx, {
        type: 'bar',
        data: {
            labels: status_titulo,
            datasets: [{
                label: '',
                data: status_quantidade,
                backgroundColor: [
                    'rgb(68, 91, 143)',
                    'rgb(89, 71, 146)',
                    'rgb(145, 104, 22)',
                    'rgb(145, 124, 22)',
                    'rgb(213, 142, 89)',
                    'rgb(14, 90, 82)',
                    'rgb(72, 18, 96)',
                    'rgb(7, 25, 68)',
                    'rgb(118, 186, 78)',
                    'rgb(77, 171, 0)',
                    'rgb(87, 100, 201)',
                    'rgb(192, 0, 0)',

                ],
                hoverOffset: 4
            }]
        },
        options: {
            interaction: {
                mode: 'nearest',
                responsive: true,
                maintainAspectRatio: false,
                intersect: true // Isso faz com que os eventos de interação não afetem a visibilidade dos datasets
            },
            plugins: {
                legend: {
                    display: false // Mantenha a legenda se você quiser, mas a interatividade não permitirá ocultar
                }
            }
        }
    });

}



/// GRÁFICO TAGS  

const tags = document.getElementById('ChartTags');

if (tags) {

    var tags_titulo = [];


    $('.tags_titulo').each(function () {
        var texto = $(this).text().trim();
        tags_titulo.push(texto);
    });

    var tags_quantidade = [];
    $('.tags_quantidade').each(function () {
        var texto = $(this).text().trim();
        tags_quantidade.push(texto);
    });





    new Chart(tags, {
        type: 'bar',
        data: {
            labels: tags_titulo,
            datasets: [{
                label: '',
                data: tags_quantidade,
                backgroundColor: [
                    'rgb(68, 91, 143)',
                    'rgb(89, 71, 146)',
                    'rgb(145, 104, 22)',
                    'rgb(145, 124, 22)',
                    'rgb(213, 142, 89)',
                    'rgb(14, 90, 82)',
                    'rgb(72, 18, 96)',
                    'rgb(7, 25, 68)',
                    'rgb(118, 186, 78)',
                    'rgb(77, 171, 0)',
                    'rgb(87, 100, 201)',
                    'rgb(192, 0, 0)',

                ],
                hoverOffset: 4
            }]
        },
        options: {
            interaction: {
                mode: 'nearest',
                responsive: true,
                maintainAspectRatio: false,
                intersect: true // Isso faz com que os eventos de interação não afetem a visibilidade dos datasets
            },
            plugins: {
                legend: {
                    display: false // Mantenha a legenda se você quiser, mas a interatividade não permitirá ocultar
                }
            }
        }
    });

}



/// ATENDIMENTO POR USUÁRIO

const atendimento_usuario = document.getElementById('ChartAtendimentoUsuario');

if (atendimento_usuario) {


    var usuario_nome = [];


    $('.usuario_nome').each(function () {
        var texto = $(this).text().trim();
        usuario_nome.push(texto);
    });

    var usuario_quantidade = [];
    $('.usuario_quantidade').each(function () {
        var texto = $(this).text().trim();
        usuario_quantidade.push(texto);
    });


    new Chart(atendimento_usuario, {
        type: 'bar',
        data: {
            labels: usuario_nome,
            datasets: [{
                label: '',
                data: usuario_quantidade,
                backgroundColor: [
                    'rgb(68, 91, 143)',
                    'rgb(89, 71, 146)',
                    'rgb(145, 104, 22)',
                    'rgb(145, 124, 22)',
                    'rgb(213, 142, 89)',
                    'rgb(14, 90, 82)',
                    'rgb(72, 18, 96)',
                    'rgb(7, 25, 68)',
                    'rgb(118, 186, 78)',
                    'rgb(77, 171, 0)',
                    'rgb(87, 100, 201)',
                    'rgb(192, 0, 0)',

                ],
                hoverOffset: 4
            }]
        },
        options: {
            interaction: {
                mode: 'nearest',
                responsive: true,
                maintainAspectRatio: false,
                intersect: true // Isso faz com que os eventos de interação não afetem a visibilidade dos datasets
            },
            plugins: {
                legend: {
                    display: false // Mantenha a legenda se você quiser, mas a interatividade não permitirá ocultar
                }
            }
        }
    });

}




/// TOTAL EMPREENDIMENTOS

const chart_total_empreendimentos = document.getElementById('ChartTotalEmpreendimentos');

if (chart_total_empreendimentos) {

    let total_empreendimento = $('#val_total_empreendimento').text();

    new Chart(chart_total_empreendimentos, {
        type: 'bar',
        data: {
            labels: [
                'Empreendimentos',
            ],
            datasets: [{
                label: '',
                data: [total_empreendimento],
                backgroundColor: [
                    'rgb(54, 162, 235)',

                ],
                hoverOffset: 4
            }]
        },
        options: {
            interaction: {
                mode: 'nearest',
                responsive: true,
                maintainAspectRatio: false,
                intersect: true // Isso faz com que os eventos de interação não afetem a visibilidade dos datasets
            },
            plugins: {
                legend: {
                    display: false // Mantenha a legenda se você quiser, mas a interatividade não permitirá ocultar
                }
            }
        }
    });

    chart_total_empreendimentos.height  = 400;

}


/// TOTAL CLIENTES

const chart_total_clientes = document.getElementById('ChartTotalClientes');

if (chart_total_clientes) {

    let total_clientes = $('#val_total_clientes').text();


    new Chart(chart_total_clientes, {
        type: 'bar',
        data: {
            labels: [
                'Clientes',
            ],
            datasets: [{
                label: '',
                data: [total_clientes],
                backgroundColor: [
                    'rgb(74,20,36)',

                ],
                hoverOffset: 4
            }]
        },
        options: {
            interaction: {
                mode: 'nearest',
                responsive: true,
                maintainAspectRatio: false,
                intersect: true // Isso faz com que os eventos de interação não afetem a visibilidade dos datasets
            },
            plugins: {
                legend: {
                    display: false // Mantenha a legenda se você quiser, mas a interatividade não permitirá ocultar
                }
            }
        }
    });

}


/// TOTAL EQUIPE

const chart_total_Equipe = document.getElementById('ChartTotalEquipe');

if (chart_total_Equipe) {

    let total_Equipe = $('#val_total_equipe').text();


    new Chart(chart_total_Equipe, {
        type: 'bar',
        data: {
            labels: [
                'Equipe',
            ],
            datasets: [{
                label: '',
                data: [total_Equipe],
                backgroundColor: [
                    'rgb(28,76,32)',

                ],
                hoverOffset: 4
            }]
        },
        options: {
            interaction: {
                mode: 'nearest',
                responsive: true,
                maintainAspectRatio: false,
                intersect: true // Isso faz com que os eventos de interação não afetem a visibilidade dos datasets
            },
            plugins: {
                legend: {
                    display: false // Mantenha a legenda se você quiser, mas a interatividade não permitirá ocultar
                }
            }
        }
    });

}




const ctx = document.getElementById('myChart').getContext('2d');

var leads_mes = [];
$('.leads_mes').each(function () {
    var texto = $(this).text().trim();
    leads_mes.push(texto);
});

var leads_total = [];
$('.leads_total').each(function () {
    var texto = $(this).text().trim();
    leads_total.push(texto);
});

const myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: leads_mes,
        datasets: [
            {
                label: 'leads',
                data: leads_total,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            },
            // {
            //     label: 'Compras',
            //     data: [20, 30, 35, 40, 45, 55, 60, 70, 80, 90, 100, 110],
            //     backgroundColor: 'rgba(255, 99, 132, 0.2)',
            //     borderColor: 'rgba(255, 99, 132, 1)',
            //     borderWidth: 1
            // },
            // {
            //     label: 'Exportações',
            //     data: [10, 20, 25, 30, 35, 45, 50, 60, 70, 80, 90, 100],
            //     backgroundColor: 'rgba(54, 162, 235, 0.2)',
            //     borderColor: 'rgba(54, 162, 235, 1)',
            //     borderWidth: 1
            // }
        ]
    },
    options: {
        interaction: {
            mode: 'nearest',
            responsive: true,
            maintainAspectRatio: false,
            intersect: true // Isso faz com que os eventos de interação não afetem a visibilidade dos datasets
        },
        plugins: {
            legend: {
                display: false // Mantenha a legenda se você quiser, mas a interatividade não permitirá ocultar
            }
        }
    }
});