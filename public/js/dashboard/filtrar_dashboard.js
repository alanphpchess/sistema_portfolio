$('#filtrar_dashboard').click(function() {

    var formData = $('.form_filtrar_dashboard').serializeArray();
    var jsonData = {};

    $(formData).each(function (index, obj) {
        jsonData[obj.name] = obj.value;
    });


    $.ajax({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'POST',
        url: '/admin/dashboard/filtro',
        data: jsonData,
    
        dataType: 'json', 

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

