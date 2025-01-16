<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Processo</title>
    <style>

        table{
            margin-left: auto;
            margin-right: auto;
        }
        .styled-table thead tr {
            background-color: #04092d;
            color: #ffffff;
            text-align: left;
        }

        .bg-blue {
            background-color: #51567d;
            color: #ffffff;
            text-align: left;  
            font-weight: bold;
            text-transform: uppercase;
        }

        .title{
            text-align: center;
        }

        .color-blue{
            font-weight: bold;
            color: #04092d;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #b21b1b;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #04092d;
        }

        .styled-table tbody tr.active-row {
            font-weight: bold;
            color: #009879;
        }

    </style>
</head>

<body>

    <div class="container">
   
        <table class="styled-table">
            <thead>
                <tr>
                    <th colspan="4" class="bg-blue title">CLIENTE <?= date("d/m/Y"); ?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="bg-blue">Nome</td>
                    <td class="color-blue">{{ $cliente['nome']}}</td>
                    <td class="bg-blue">Empreendimento</td>
                    <td class="color-blue">{{ $cliente->empreendimentos->nome_empreendimento}}</td>
                </tr>
                <tr class="active-row">
                    <td class="bg-blue">Telefone</td>
                    <td class="color-blue">{{ $cliente['telefone']}}</td>
                    <td class="bg-blue">Celular</td>
                    <td class="color-blue">{{ $cliente['celular']}}</td>
                </tr>
                <tr class="active-row">
                    <td class="bg-blue">1º E-mail</td>
                    <td class="color-blue">{{ $cliente['email1']}}</td>
                    <td class="bg-blue">2º E-mail</td>
                    <td class="color-blue">{{ $cliente['email2']}}</td>
                </tr>
                <tr class="active-row">
                    <td class="bg-blue">Data Criação</td>
                    <td class="color-blue">
                <?php echo ($cliente['data_criacao'] !== null) ? date("d/m/Y", strtotime($cliente['data_criacao'])) : ""; ?></td>

                    <td class="bg-blue">Data Atualização</td>
                    <td class="color-blue">  <?php echo ($cliente['data_criacao'] !== null) ? date("d/m/Y", strtotime($cliente['data_atualizacao'])) : ""; ?></td>
                </tr>
                <tr class="active-row">
                    <td class="bg-blue">Data Lead</td>
                    <td class="color-blue">  <?php echo ($cliente['data_lead'] !== null) ? date("d/m/Y", strtotime($cliente['data_criacao'])) : ""; ?></td>

                </tr>
                <tr class="active-row">
                    <td class="bg-blue">CEP</td>
                    <td class="color-blue">{{ $cliente['cep']}}</td>
                    <td class="bg-blue">Endereço</td>
                    <td class="color-blue">{{ $cliente['endereco']}}</td>
                </tr>
                <tr class="active-row">
                    <td class="bg-blue">Número</td>
                    <td class="color-blue">{{ $cliente['numero']}}</td>
                    <td class="bg-blue">Bairro</td>
                    <td class="color-blue">{{ $cliente['bairro']}}</td>
                </tr>
                <tr class="active-row">
                    <td class="bg-blue">Cidade</td>
                    <td class="color-blue">{{ $cliente['cidade']}}</td>
                    <td class="bg-blue"></td>
                    <td class="color-blue"></td>
                </tr>
                <!-- and so on... -->
            </tbody>
        </table>
  
    </div>


</body>

</html>
