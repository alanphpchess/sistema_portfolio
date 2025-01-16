$('.form-news').submit(function (e) {

    $.ajax({
        method: 'GET',
        url: 'email/sendemailnews',
        data: $('.form-news').serialize(),
        dataType: 'json',
        beforeSend: function () {
            let timerInterval
            Swal.fire({
                html: '<h4>Encaminhando e-mail...</h4>',
                width: 300,
                timer: 30000,
                heightAuto: true,
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {

                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                }
            })
        },
        success: function (data) {

            if(data.response.status == true){
                Swal.fire({
                    html: 'E-mail enviado com sucesso!',
                    width: 300,
                    heightAuto: true,
                    position: 'center',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3500
                });

                $('input, textarea').val('');
            }else{

                Swal.fire({
                    html: 'E-mail não enviado!',
                    width: 300,
                    heightAuto: true,
                    position: 'center',
                    icon: 'error',
                    showConfirmButton: false,
                    timer: 3500
                });
            }

        },
        error: function () {

        },
        complete: function () {
        }
    });
    return false;


});


