
$('#btn_inserir_cliente').click(function () {

    $('#form_add_cli').serialize();

    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 8000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        }
    });

    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'get',
        url: '/admin/clientes/inserir_cliente',
        contentType: 'application/json',
        data: $('#form_add_cli').serialize(),
        dataType: 'json',
        beforeSend: function () {
        },
        success: function (data) {

            if (data.status == true) {

                Toast.fire({
                    icon: "success",
                    title: 'Cliente salvo com sucesso!'
                });

                $('#tabelaClientes').DataTable().ajax.reload();
                $('#ModalAddCliente').modal('hide');
                $('#form_add_cli')[0].reset();

                selectEmpreendimentos_2.clear(); 
                selectSedes.clear(); 

            } else {

                Toast.fire({
                    icon: "error",
                    title: data.message
                });



            }
        },
        error: function (xhr, status, error) {


        },
        complete: function () {

        }
    });

});



// Instanciando o TomSelect para Empreendimentos primeiro
const selectEmpreendimentos_2 = new TomSelect('.select_empreendimentos_2', {
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


    },
    onItemRemove: function (value) {
        const json_data = JSON.stringify({
            'ids_empreendimentos': this.getValue(),
            'ids_sedes': selectSedes.getValue()
        });


    }
});

// Instanciando o TomSelect para Sedes
const selectSedes = new TomSelect('.select_sedes_2', {
    create: false,
    maxItems: 30,
    onInitialize: function () {
        // Inicializa com fetchSedes, passando selectEmpreendimentos_2 após inicialização
        fetchSedes(this.getValue(), true, this, selectEmpreendimentos_2);
    },
    onItemAdd: function (id_sede) {
        const json_data = JSON.stringify({
            'ids_sedes': this.getValue(),
            'ids_empreendimentos': selectEmpreendimentos_2.getValue()
        });


        fetchEmpreendimentos(this.getValue(), false, selectEmpreendimentos_2);
    },
    onItemRemove: function (value) {
        const json_data = JSON.stringify({
            'ids_sedes': this.getValue(),
            'ids_empreendimentos': selectEmpreendimentos_2.getValue()
        });


        fetchEmpreendimentos(this.getValue(), false, selectEmpreendimentos_2);
    }
});

function fetchSedes(ids_sedes, opcoes_salvas, selectSedes, selectEmpreendimentos_2) {
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
                selectEmpreendimentos_2.clearOptions(); // Limpar opções antes de adicionar
                console.log(data.filtro_ids_empreendimentos);
                data.filtro_ids_empreendimentos.forEach(function (opcao) {
                    selectEmpreendimentos_2.addOption({
                        value: opcao.id,
                        text: opcao.nome
                    });
                });

                if (data.filtro_options_empreendimentos) {
                    console.log(data.filtro_options_empreendimentos);
                    selectEmpreendimentos_2.setValue(data.filtro_options_empreendimentos);
                }
            }
        },
        error: function (xhr, status, error) {
            console.error("Erro ao buscar sedes:", error);
        }
    });
}

function fetchEmpreendimentos(ids_sedes, opcoes_salvas, selectEmpreendimentos_2) {
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
                selectEmpreendimentos_2.clearOptions(); // Limpar opções antes de adicionar
                data.empreendimentos.forEach(function (opcao) {
                    selectEmpreendimentos_2.addOption({
                        value: opcao.id,
                        text: opcao.nome
                    });
                });
                if (data.opcoes_salvas) {
                    selectEmpreendimentos_2.setValue(data.opcoes_salvas);
                }
            }
        },
        error: function (xhr, status, error) {
            console.error("Erro ao buscar empreendimentos:", error);
        }
    });
}




