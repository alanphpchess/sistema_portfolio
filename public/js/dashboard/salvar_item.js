$('#salvar_dashboard').click(function() {

    itens_dashboard = [];

    $('#RightListComponent li').each(function() {

        let item = $(this).attr('data-target');

        itens_dashboard.push(item)

    });

    itens_dashboard = itens_dashboard.filter(function(value) {
        return value !== null && value !== undefined;
    });


    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: '/admin/dashboard/salvar_itens',
        data: {
            itens: itens_dashboard
        },
        dataType: 'json', // Define o tipo de dados esperado como JSON

        beforeSend: function () {
  
        },
        success: function (data) {

            if(data.status){
                location.reload();
            }


        },
        error: function () {
  
        },
        complete: function () {
  
        }
     });

});