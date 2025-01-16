
if ($('.select_image').length > 0) {

    new TomSelect('.select_image', {
        render: {
            option: function (data, escape) {
                return `<div><img class="me-2" width="25" src="${data.src}">${data.text}</div>`;
            },
            item: function (item, escape) {
                return `<div><img class="me-2" width="25" src="${item.src}">${item.text}</div>`;
            }
        }
    });

}

if ($('.select_edit_pasta').length > 0) {

    new TomSelect('.select_edit_pasta', {
        render: {
            option: function (data, escape) {
                return `<div><img class="me-2" width="25" src="${data.src}">${data.text}</div>`;
            },
            item: function (item, escape) {
                return `<div><img class="me-2" width="25" src="${item.src}">${item.text}</div>`;
            }
        }
    });

}


if ($('.select_multiple').length > 0) {
   $ts_multiple =  new TomSelect('.select_multiple', {
        create: true,
        maxItems: 30
    });
    


}

