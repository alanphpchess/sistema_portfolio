function roleta() {
    $.ajax({
        method: 'GET',
        url: '/admin/portais/roleta',
        data: {

        },
        beforeSend: function () {

        },
        success: function (data) {
            if (data.status == true) {
                

                $('#tabelaPortais').DataTable().ajax.reload();

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

                $('#tabelaPortais').DataTable().ajax.reload();
                
                Toast.fire({
                    icon: "success",
                    title: 'Atualizado com sucesso!'
                });

            }
        },
        error: function () {
            // Tratamento de erro, se necessário
        }
    });
}


// Chamada a cada 5 segundos
setInterval(function() {
    roleta();
}, 1000);


function verificar_tempo_roleta() {
    $.ajax({
        method: 'GET',
        url: 'portais/verificar_tempo_roleta',
        data: {

        },
        beforeSend: function () {

        },
        success: function (data) {
            if (data.status == true) {
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

                $('#tabelaPortais').DataTable().ajax.reload();
                Toast.fire({
                    icon: "success",
                    title: data.message
                });
            }
        },
        error: function () {
            // Tratamento de erro, se necessário
        }
    });
}


// Chamada a cada 5 segundos
setInterval(function() {
    // verificar_tempo_roleta();
}, 5000);
