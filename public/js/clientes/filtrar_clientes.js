
window.onload = function() {
    function filtro_dt_cliente(json_data) {

        $.ajax({
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            url: '/admin/clientes/salvar_filtro',
            contentType: 'application/json',
            dataType: 'json',
            data: json_data,
            beforeSend: function () {
            },
            success: function (data) {

                if (data.status == true) {
                    $('#tabelaClientes').DataTable().ajax.reload();
                }

            },
            error: function (xhr, status, error) {
            },
            complete: function () {

            }
        });

    }

    $('#data_inicio').on('change', function () {

        const data_criacao = this.value;

        const json_data = JSON.stringify({
            'data_criacao': data_criacao
        });

        filtro_dt_cliente(json_data);

    });

    $('#data_fim').on('change', function () {

        const data_fim = this.value;

        const json_data = JSON.stringify({
            'data_fim': data_fim
        });

        filtro_dt_cliente(json_data);
    });


    $('#fonte').on('change', function () {
        const id_fonte = this.value;

        const json_data = JSON.stringify({
            'id_fonte': id_fonte
        });

        filtro_dt_cliente(json_data);
    });

    $('#corretor').on('change', function () {

        const id_corretor = this.value;

        const json_data = JSON.stringify({
            'id_corretor': id_corretor
        });

        filtro_dt_cliente(json_data);
    });

    $('#status').on('change', function () {
        const id_status = this.value;

        const json_data = JSON.stringify({
            'id_status': id_status
        });

        filtro_dt_cliente(json_data);
    });

    $('#email').on('focusout', function () {
        const email = this.value;

        const json_data = JSON.stringify({
            'email': email
        });

        filtro_dt_cliente(json_data);
    });

    $('#telefone').on('focusout', function () {
        const telefone = this.value;

        const json_data = JSON.stringify({
            'telefone': telefone
        });

        filtro_dt_cliente(json_data);
    });

    $('#cliente').on('focusout', function () {
        const nome_cliente = this.value;

        const json_data = JSON.stringify({
            'nome_cliente': nome_cliente
        });

        filtro_dt_cliente(json_data);
    });

    $('#ids_empreendimentos').on('focusout', function () {
        const ids_empreendimentos = this.value;

        const json_data = JSON.stringify({
            'ids_empreendimentos': ids_empreendimentos
        });

        filtro_dt_cliente(json_data);
    });

    $('.ids_sedes').on('focusout', function () {
        const ids_sedes = this.value;

        const json_data = JSON.stringify({
            'ids_sedes': ids_sedes
        });

        filtro_dt_cliente(json_data);
    });




    $('#search-input_clientes').on('keyup', function () {
        tabelaClientes.search(this.value).draw();
    });


    $('.check-all_database').click(function () {
        if ($(this).is(':checked')) {
            tabelaClientes.rows().select();
        } else {
            tabelaClientes.rows().deselect();
        }
    });

// Instanciando o TomSelect para Empreendimentos primeiro
const selectEmpreendimentos = new TomSelect('.select_empreendimentos', {
    create: false,
    maxItems: 30,
    onInitialize: function () {
        // Inicializa vazio por enquanto
    },
    onItemAdd: function (id_empreendimento) {
        const json_data = JSON.stringify({
            'ids_empreendimentos': this.getValue(),
            'ids_sedes': selectSedes.getValue()
        });

        filtro_dt_cliente(json_data);
    },
    onItemRemove: function (value) {
        const json_data = JSON.stringify({
            'ids_empreendimentos': this.getValue(),
            'ids_sedes': selectSedes.getValue()
        });

        filtro_dt_cliente(json_data);
    }
});

// Instanciando o TomSelect para Sedes
const selectSedes = new TomSelect('.select_sedes', {
    create: false,
    maxItems: 30,
    onInitialize: function () {
        // Inicializa com fetchSedes, passando selectEmpreendimentos após inicialização
        fetchSedes(this.getValue(), true, this, selectEmpreendimentos);
    },
    onItemAdd: function (id_sede) {
        const json_data = JSON.stringify({
            'ids_sedes': this.getValue(),
            'ids_empreendimentos': selectEmpreendimentos.getValue()
        });

        filtro_dt_cliente(json_data);
        fetchEmpreendimentos(this.getValue(), false, selectEmpreendimentos);
    },
    onItemRemove: function (value) {
        const json_data = JSON.stringify({
            'ids_sedes': this.getValue(),
            'ids_empreendimentos': selectEmpreendimentos.getValue()
        });

        filtro_dt_cliente(json_data);
        fetchEmpreendimentos(this.getValue(), false, selectEmpreendimentos);
    }
});

function fetchSedes(ids_sedes, opcoes_salvas, selectSedes, selectEmpreendimentos) {
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'get',
        url: '/admin/clientes/option_select_sedes',
        contentType: 'application/json',
        data: {
            ids_sedes: ids_sedes,
            opcoes_salvas: opcoes_salvas
        },
        dataType: 'json',
        success: function (data) {
            if (data && data.filtro_options_sedes) {
                selectSedes.clearOptions(); // Limpar opções antes de adicionar
                data.filtro_options_sedes.forEach(function (opcao) {
                    selectSedes.addOption({
                        value: opcao.id,
                        text: opcao.nome
                    });
                });
                if (data.filtro_ids_sedes) {
                    selectSedes.setValue(data.filtro_ids_sedes);
                }
            }

            if (data && data.filtro_options_empreendimentos) {
                selectEmpreendimentos.clearOptions(); // Limpar opções antes de adicionar
                console.log(data.filtro_ids_empreendimentos);
                data.filtro_ids_empreendimentos.forEach(function (opcao) {
                    selectEmpreendimentos.addOption({
                        value: opcao.id,
                        text: opcao.nome
                    });
                });

                if (data.filtro_options_empreendimentos) {
                    console.log(data.filtro_options_empreendimentos);
                    selectEmpreendimentos.setValue(data.filtro_options_empreendimentos);
                }
            }
        },
        error: function (xhr, status, error) {
            console.error("Erro ao buscar sedes:", error);
        }
    });
}

function fetchEmpreendimentos(ids_sedes, opcoes_salvas, selectEmpreendimentos) {
    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'get',
        url: '/admin/clientes/option_select_empreendimento',
        contentType: 'application/json',
        data: {
            ids_sedes: ids_sedes,
            opcoes_salvas: opcoes_salvas
        },
        dataType: 'json',
        success: function (data) {
            if (data && data.empreendimentos) {
                selectEmpreendimentos.clearOptions(); // Limpar opções antes de adicionar
                data.empreendimentos.forEach(function (opcao) {
                    selectEmpreendimentos.addOption({
                        value: opcao.id,
                        text: opcao.nome
                    });
                });
                if (data.opcoes_salvas) {
                    selectEmpreendimentos.setValue(data.opcoes_salvas);
                }
            }
        },
        error: function (xhr, status, error) {
            console.error("Erro ao buscar empreendimentos:", error);
        }
    });
}



};