if ($('#cep').length) {
    $('#cep').mask('00000-000');
}


if ($('.cep').length) {
    $('.cep').mask('00000-000');
}

if ($('.cpf').length) {
    $('.cpf').mask('000.000.000-00');
}


if ($('.rg').length) {
    $('.rg').mask('00.000.000-0');
}


if ($('#edit_cep').length) {
    $('#edit_cep').mask('00000-000');
}


if ($('#cnpj').length) {
    $('#cnpj').mask('00.000.000/0000-00');
}

if ($('.cnpj').length) {
    $('.cnpj').mask('00.000.000/0000-00');
}


if ($('#telefone').length) {
    $('#telefone').mask('(00) 0000-0000');
}

if ($('.telefone').length) {
    $('.telefone').mask('(00) 0000-0000');
}

if ($('#celular').length) {
    $('#celular').mask('(00) 00000-0000');
}


if ($('.celular').length) {
    $('.celular').mask('(00) 00000-0000');
}

// Máscara para valores em reais
if ($('.reais').length) {
    $('.reais').mask('000.000.000,00', { reverse: true });
}



