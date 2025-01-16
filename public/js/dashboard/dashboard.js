
document.addEventListener('DOMContentLoaded', function () {
    var sortable = new Sortable(document.getElementById('sortable-grid'), {
        animation: 150,
        ghostClass: 'sortable-ghost',
        chosenClass: 'sortable-chosen',
        dragClass: 'sortable-drag',
        onEnd: function (evt) {

            var dashboardIds = [];

            $('[data-dashboard_id]').each(function() {

                var id = $(this).data('dashboard_id');
                dashboardIds.push(id);

            });


            $.ajax({
                method: 'POST',
                url: 'dashboard/salvar_ordem_dash',
                data: {
                   _token: $('meta[name="csrf-token"]').attr('content'),
                   dashboardIds: dashboardIds
                },
                dataType: 'json',
                beforeSend: function () {
          
                },
                success: function (data) {
          
                },
                error: function () {
          
                },
                complete: function () {
          
                }
             });
          
    
        }
    });
});
