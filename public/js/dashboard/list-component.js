
document.addEventListener('DOMContentLoaded', function () {
   let LeftListComponent = document.getElementById("LeftListComponent");
   let RightListComponent = document.getElementById("RightListComponent");

   let favorite_list = Sortable.create(LeftListComponent, {
      animation: 150,
      group: "shared",
      ghostClass: "sortable-ghost",
   });
   let other_list = Sortable.create(RightListComponent, {
      animation: 150,
      group: "shared",
      ghostClass: "sortable-ghost"
   });


   $.ajax({
      method: 'POST',
      url: 'get_list_component',
      data: {
         _token: $('meta[name="csrf-token"]').attr('content')
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



});


