$(document).ready(function() {

    function limpa_formulário_cep() {
        // Limpa valores do formulário de cep.
        $("#edit_endereco").val("");
        $("#edit_bairro").val("");
        $("#edit_cidade").val("");

  
    }

    //Quando o campo cep perde o foco.
    $("#edit_cep").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#edit_endereco").val("...");
                $("#edit_bairro").val("...");
                $("#edit_cidade").val("...");
                $("#edit_cidade").val("...");
                $('#edit_estado').val('...');

          

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.

                        console.log(dados.estado);
                        $("#edit_endereco").val(dados.logradouro);
                        $("#edit_bairro").val(dados.bairro);
                        $("#edit_cidade").val(dados.localidade);
                        $('#edit_estado').val(dados.estado);
                     

        
              
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        limpa_formulário_cep();
                        const Toast =   Swal.mixin({
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
            
                          Toast.fire({
                            icon: "error",
                            title: 'CEP não encontrado!'
                          });
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    });
});