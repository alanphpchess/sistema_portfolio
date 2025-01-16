$(document).ready(function () {
    let columns = $('#tabelaClientes').DataTable().settings().init().columns;
    let columnStates = localStorage.getItem('columnStates');

    // Restaura o estado das colunas ao carregar a página
    if (columnStates) {
        $.each(JSON.parse(columnStates), function(columnIdx, isVisible) {
            $('#tabelaClientes').DataTable().column(columnIdx).visible(isVisible);
        });
    }

    $.each(columns, function(i, v) {
        if (i > 1 && i != 12) {
            let isVisible = $('#tabelaClientes').DataTable().column(i).visible();
            let checkboxClass = isVisible ? 'text-success_2' : 'text-danger_2';

            $('#clientes-gridColumns').append(
                '<div class="form-group col-sm-6 mb-2">' +
                '<label class="checkbox-datatable">' +
                '<input type="checkbox" class="filled-in" data-column="' + i + '" ' + (isVisible ? 'checked' : '') + '>' +
                '<span class="checkbox-label ' + checkboxClass + '">' + $($('#tabelaClientes').DataTable().column(i).header()).html() + '</span>' +
                '</label>' +
                '</div>'
            );
        }
    });

    // Adiciona o evento de clique aos checkboxes
    document.querySelectorAll('.checkbox-datatable input[type="checkbox"]').forEach((el) => {
        el.addEventListener('change', function (e) {
            e.preventDefault();

            let columnIdx = el.getAttribute('data-column');
            let column = $('#tabelaClientes').DataTable().column(columnIdx);

            if (el.checked) {
                column.visible(true);
                el.nextElementSibling.classList.remove('text-danger_2');
                el.nextElementSibling.classList.add('text-success_2');
            } else {
                column.visible(false);
                el.nextElementSibling.classList.remove('text-success_2');
                el.nextElementSibling.classList.add('text-danger_2');
            }

            let states = JSON.parse(localStorage.getItem('columnStates')) || {};
            states[columnIdx] = column.visible();
            localStorage.setItem('columnStates', JSON.stringify(states));
        });
    });
});
