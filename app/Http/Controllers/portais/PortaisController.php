<?php

namespace App\Http\Controllers\portais;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empreendimentos;
use App\Models\Permissoes;
use App\Functions\Validacao;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\Facades\DataTables;
use App\Models\Users;
use Illuminate\Support\Str;
use App\Models\Img_empreendimentos;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Cat_pasta_emp;
use App\Models\Pastas;
use App\Models\Fontes;
use App\Models\tags;
use App\Models\Roleta;
use App\Models\Roleta_Usuario;
use App\Models\Portais;
use App\Models\Clientes;
use App\Models\EmailContato;
use App\Jobs\InsertRecordJob;
use Carbon\Carbon;



class PortaisController extends Controller
{

    function __construct()
    {
        date_default_timezone_set('America/Sao_Paulo');
    }

    public function index()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $bd_users_todos = Users::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();


        $permissoes = Permissoes::where('id_usuario', $bd_users->id)->get();

        $lista_permissao = [];
        foreach ($permissoes as $permissao) {
            $lista_permissao[$permissao->nome] = $permissao->ativo;
        }
        if ($bd_users->permissao == 'Administrador') {
            $user_admin = 1;
        } else {
            $user_admin = 0;
        }

        $dataParaInserir = [
            'id_cliente_primario' => '1',
            'id_empreendimento' => '1',
            'nome' => 'teste',
            'email' => 'alan@email.com.br',
            'telefone' => '(11) 984477317',
        ];

        InsertRecordJob::dispatch($dataParaInserir);

        /// FIM PERMISSÕES

        return view('portais.vw-portais', [
            'permissoes' => $lista_permissao,
            'user_admin' => $user_admin,
            'user_todos' => $bd_users_todos
        ]);
    }



    public function salvar()
    {

        if (empty(request()->nome)) {

            return response()->json([
                'status' => false,
                'message' => 'Campo nome do empreendimento é obrigatório!',
            ]);
        }

        $bd_users =  Users::where('id', auth()->user()->id)->first();
        $bd_empreendimentos = Empreendimentos::where('nome_empreendimento', request()->nome)->first();

        if (!empty($bd_empreendimentos)) {

            return response()->json([
                'status' => false,
                'message' => 'Nome do Empreendimento já existe',
            ]);
        } else {

            $bd_empreendimentos = new Empreendimentos();
        }

        $bd_empreendimentos->nome_empreendimento = request()->nome;
        $bd_empreendimentos->cep = request()->cep;
        $bd_empreendimentos->endereco = request()->endereco;
        $bd_empreendimentos->numero = request()->numero;
        $bd_empreendimentos->complemento = request()->complemento;
        $bd_empreendimentos->referencia = request()->referencia;
        $bd_empreendimentos->bairro_empreendimento = request()->bairro;
        $bd_empreendimentos->cidade_empreendimento = request()->cidade;
        $bd_empreendimentos->zona = request()->zona;
        $bd_empreendimentos->estado_empreendimento = request()->estado;
        $bd_empreendimentos->finalidade = request()->finalidade;
        $bd_empreendimentos->tipo_imovel = request()->tipo_imovel;
        $bd_empreendimentos->etapa = request()->etapa;
        $bd_empreendimentos->localizacao = request()->localizacao;
        $bd_empreendimentos->torres = request()->torres;
        $bd_empreendimentos->andares = request()->andares;
        $bd_empreendimentos->elevadores = request()->elevadores;
        $bd_empreendimentos->dormitorios = request()->dormitorios;
        $bd_empreendimentos->suites = request()->suites;
        $bd_empreendimentos->vagas = request()->vagas;
        $bd_empreendimentos->area_util = request()->area_util;
        $bd_empreendimentos->area_construida = request()->area_construida;
        $bd_empreendimentos->area_terreno = request()->area_terreno;
        $bd_empreendimentos->area_total = request()->area_total;
        $bd_empreendimentos->descricao = request()->descricao;
        $bd_empreendimentos->anotacao = request()->anotacao;
        $bd_empreendimentos->tipo_contrato = request()->tipo_contrato;
        $bd_empreendimentos->valor_locacao = request()->valor_locacao;
        $bd_empreendimentos->valor_empreendimento = request()->valor_venda;
        $bd_empreendimentos->email = request()->email;
        $bd_empreendimentos->telefone = request()->telefone;
        $bd_empreendimentos->tipo_id = request()->tipo_id;
        $bd_empreendimentos->clientes_primarios_id_cliente_primario = $bd_users->clientes_primarios_id_cliente_primario;


        if ($bd_empreendimentos->save()) {

            Validacao::mensagem(true, 'Salvo com sucesso!');

            return response()->json([
                'status' => true,
                'message' => 'Salvo com sucesso!',
            ]);
        } else {

            return response()->json([
                'status' => false,
                'message' => 'Erro para salvar!',
            ]);
        }
    }

    public function datatable_portais()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();


        $db_emails = DB::table('email_contato')
            ->where('tipo', 2)
            ->where('id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);



        return Datatables::of($db_emails)


            ->addColumn('time', function ($data) {
                $data = '1/1/2017';
                $timestamp = strtotime($data . "+6 months");
                $dia_hora_atual = strtotime(date("Y-m-d"));
                $diferenca = $timestamp - $dia_hora_atual;
                $dias = ($diferenca / 86400);
                return "$dias dia(s)";
            })
            ->addColumn('nome_empreendimento', function ($data) {
                $empreendimento = Empreendimentos::where('id_empreendimento', $data->id_empreendimento)->first();

                if(!empty($empreendimento->nome_empreendimento)){
                    return $empreendimento->nome_empreendimento;
                }


            })
            ->addColumn('usuario', function ($data) {
                $usuario = Users::where('id', $data->id_usuario)->first();


                if (!empty($usuario)) {
                    return $usuario->name;
                }
            })
            ->addColumn('action', function ($data) {

                $bd_users =  Users::where('id', auth()->user()->id)->first();

                $permissoes_excluir = Permissoes::where('id_usuario', $bd_users->id)->where('nome', 'funcao_excluir_emp')
                    ->first();

                // if ($bd_users->permissao == 'Administrador') {
                $btn_excluir = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-portais" data-target="' . $data->id . '"><i class="ri-delete-bin-5-line"></i> Excluir</button>';
                // } else if (!empty($permissoes_excluir)) {

                //     if ($permissoes_excluir->ativo == 'true' || $bd_users->permissao == 'Administrador') {
                //         $btn_excluir = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-portais" data-target="' . $data->id . '"><i class="ri-delete-bin-5-line"></i> Excluir</button>';
                //     } else {
                //         $btn_excluir = '';
                //     }
                // } else {
                //     $btn_excluir = '';
                // }

                $btn_direcionar_usuario = '<button class="bttn-material-flat bttn-xs bttn-primary btn-direcionar-cliente" data-target="' . $data->id . '"><i class="ri-user-fill"></i> ALTERAR</button>';

                $btn_encaminhar_cliente = '<button class="bttn-material-flat bttn-xs bttn-success btn-encaminhar-cliente" data-target="' . $data->id . '"><i class="ri-arrow-right-fill"></i> Prosseguir Cliente</button>';

                return   $btn_direcionar_usuario . " " . $btn_encaminhar_cliente . " " . $btn_excluir;
            })
            ->rawColumns(['action', 'img_principal', 'numeros_imgs', 'arquivos', 'time'])
            ->toJson();
    }

    public function excluir()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $db_portais = Portais::where('id', request()->id)
            ->where('id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);

        if (!empty($db_portais->first())) {

            $db_portais->delete();

            return response()->json([
                'status' => true,
                'message' => 'Exclusão efetuada com sucesso!',
            ]);
        }
    }

    public function roleta()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $bd_empreendimentos = Empreendimentos::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();

        $bd_roletas = Roleta::where('id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();


        $numeroDoDiaDaSemana = date('N');

        foreach ($bd_roletas as $roleta) {

            /// NÃO TEM NENHUM ID ROLETA SETADO NA TABELA EMAILCONTATO

            $roleta_emails_null_id_roleta  = EmailContato::where('id_cliente_primario', $roleta->id_cliente_primario)->whereNull('id_roleta');

            $roleta_emails_null_id_roleta =  $roleta_emails_null_id_roleta->get();



            //COLOCA O ID DA ROLETA EM EMAIL CONTATO
            if (!empty($roleta_emails_null_id_roleta)) {

                foreach ($roleta_emails_null_id_roleta as $roleta_email) {

                    $roleta_email->id_roleta = $roleta->id;
                    $roleta_email->save();
                }
            }

            $roleta_usuarios = Roleta_Usuario::where('id_roleta', $roleta->id)
                ->orderBy('ordem', 'asc')
                ->get();


            if ($roleta_usuarios->isNotEmpty()) {

                // Itera sobre cada EmailContato
                $db_emails_contato = EmailContato::where('id_cliente_primario', $roleta->id_cliente_primario)->get();

                $totalUsuarios = count($roleta_usuarios);
                $currentUserIndex = 0; // Índice do usuário atual

                foreach ($db_emails_contato as $emails_contato) {

                    if ($emails_contato->data_roleta == null || Carbon::now()->greaterThan($emails_contato->data_roleta)) {

                        // Verifica se o usuário atual deve ser atualizado
                        if ($totalUsuarios > 0) {
                            $ru = $roleta_usuarios[$currentUserIndex];

                            // Atualiza o EmailContato com o usuário atual
                            $ec = EmailContato::find($emails_contato->id);
                            $ec->id_usuario = $ru->id_usuario;
                            $ec->data_roleta = Carbon::now()->addMinutes($ru->tempo);
                            $ec->save();

                            // Atualiza a roleta atual para o usuário atual e próximo
                            $ru_atualizar_roleta_atual = Roleta_Usuario::find($ru->id);
                            $ru_atualizar_roleta_atual->roleta_atual = 0;
                            $ru_atualizar_roleta_atual->save();

                            // Identifica o próximo usuário
                            $nextUserIndex = ($currentUserIndex + 1) % $totalUsuarios;
                            $nextUser = $roleta_usuarios[$nextUserIndex];

                            $ru_atualizar_roleta_atual_prox_indice = Roleta_Usuario::find($nextUser->id);
                            $ru_atualizar_roleta_atual_prox_indice->roleta_atual = 1;
                            $ru_atualizar_roleta_atual_prox_indice->save();

                            // Atualiza o índice do usuário atual para a próxima iteração
                            $currentUserIndex = $nextUserIndex;
                        }
                    }
                }
            }
        }
    }

    public function roletax()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $bd_empreendimentos = Empreendimentos::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();

        $bd_roletas = Roleta::where('id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();

        $numeroDoDiaDaSemana = date('N');

        foreach ($bd_roletas as $roleta) {

            //VERIFICA OS DIAS DA SEMANA DA ROLETA
            if ($roleta->dias == $numeroDoDiaDaSemana || $roleta->dias == 0 || !empty($roleta->dias)) {

                $roleta_emails_null  = EmailContato::where('id_cliente_primario', $roleta->id_cliente_primario)->whereNull('id_usuario');

                // if (!empty($roleta->id_empreendimento) && $roleta->id_empreendimento != -1) {

                //     $roleta_emails_null->where('id_empreendimento', $roleta->id_empreendimento);
                // }

                // if(!empty( $roleta->id_fonte)){
                //     $roleta_emails_null->where('id_fonte', $roleta->id_fonte);
                // }

                $roleta_emails_null =  $roleta_emails_null->get();


                //COLOCA O ID DA ROLETA EM EMAIL CONTATO
                if (!empty($roleta_emails_null)) {

                    foreach ($roleta_emails_null as $roleta_email) {

                        $roleta_email->id_roleta = $roleta->id;
                        $roleta_email->save();
                    }
                }


                $primeiraOrdem = Roleta_Usuario::where('id_roleta', $roleta->id)
                    ->orderBy('ordem', 'asc')
                    ->value('ordem');


                // Obtendo a última ordem
                $ultimaOrdem = Roleta_Usuario::where('id_roleta', $roleta->id)
                    ->orderBy('ordem', 'desc')
                    ->value('ordem');

                $currentDateTime = Carbon::now('America/Sao_Paulo');
                $ordem = 0;

                $roleta_usuarios = Roleta_Usuario::where('id_roleta', $roleta->id)
                    ->orderBy('ordem', 'asc')
                    ->get();


                /// COLOCA A ORDEM
                foreach ($roleta_usuarios as $ru) {

                    $ordem++;
                    $bd_roleta_usuario = Roleta_Usuario::where('id', $roleta->id)->first();

                    $bd_roleta_usuario->id_usuario = $ru->id_usuario;
                    /// TEMPO ALTERAR
                    $bd_roleta_usuario->tempo = 15;
                    $bd_roleta_usuario->ativo = 1;
                    $bd_roleta_usuario->ordem = $ordem;
                    $bd_roleta_usuario->save();
                }

                //ORDENA A ROLETA E COLOCA O HORARIO

                foreach ($roleta_usuarios as $ru) {
                    if (empty($roleta->prazo) || $roleta->prazo === '0000-00-00 00:00:00') {

                        if ($ru->ordem == $primeiraOrdem) {

                            $currentDateTime->modify('+15 minutes');

                            $prazo_anterior = $currentDateTime->format('Y-m-d H:i:s');


                            $ru->prazo = $prazo_anterior;
                            $ru->roleta_atual = 1;
                            $ru->save();
                        } else {

                            $prazo_anterior = Carbon::parse($ru->prazo_anterior);
                            $prazo_anterior->addMinutes(15);
                            $ru->prazo = $prazo_anterior->format('Y-m-d H:i:s');
                            $ru->save();
                        }
                    }
                }



                foreach ($roleta_usuarios as $index => $ru) {

                    if ($ru->roleta_atual == 1) {

                        // Inicia a consulta
                        $db_email = EmailContato::where('id_cliente_primario', $roleta->id_cliente_primario)
                            ->whereNull('id_usuario');

                        // Adiciona condições baseadas nos valores
                        if (!empty($roleta->id_empreendimento) && $roleta->id_empreendimento != -1) {
                            $db_email->where('id_empreendimento', $roleta->id_empreendimento);
                        }

                        if (!empty($roleta->id_fonte)) {
                            $db_email->where('id_fonte', $roleta->id_fonte);
                        }

                        // Ordena a consulta
                        $db_email = $db_email->orderBy('id', 'asc')->get();

                        // Verifica se há resultados
                        if ($db_email->isNotEmpty()) {
                            // Faça algo com os resultados

                            // Calcula o próximo índice no array
                            $nextIndex = ($index + 1) % count($roleta_usuarios);

                            // Cria uma instância do Carbon com o fuso horário especificado
                            $now = Carbon::now('America/Sao_Paulo');

                            // Adiciona 1 minuto à data e hora atual
                            $now->addMinute();

                            // Formata a data e hora para o formato desejado
                            $data_roleta = $now->format('Y-m-d H:i:s');
                        }
                    }
                }
            }
        }
    }

    private function getNextUser($roletaUsuarios, $currentUserId)
    {
        // Encontrar o índice do usuário atual
        $currentIndex = $roletaUsuarios->search(function ($user) use ($currentUserId) {
            return $user->id === $currentUserId;
        });

        // Determinar o próximo usuário na lista
        $nextIndex = ($currentIndex + 1) % $roletaUsuarios->count();

        return $roletaUsuarios[$nextIndex];
    }

    public function verificar_tempo_roleta()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $roleta = Roleta::where('id_cliente_primario',  $bd_users->clientes_primarios_id_cliente_primario)->first();

        $portais = Portais::where('id_cliente_primario', $roleta->id_cliente_primario)->get();


        foreach ($portais as $portal) {

            $db_roleta = Roleta::where('id',  $portal->id_roleta)->first();

            $data_prazo_roleta = Carbon::parse($db_roleta->prazo);
            // $data_atual = Carbon::parse('2020-08-08 15:01:32');
            $data_atual_roleta = Carbon::now();

            if ($data_atual_roleta->lte($data_prazo_roleta)) {

                $prazo = Carbon::parse($portal->prazo_roleta);
                $data_atual = Carbon::now();



                if ($data_atual->lte($prazo) == false) {



                    $roleta_usuario =  Roleta_usuario::where('id_roleta', $portal->id_roleta)
                        ->orderBy('ordem', 'asc')
                        ->distinct()
                        ->pluck('id_usuario');



                    $numero_id_usuarios_roleta = count($roleta_usuario);

                    ///VERIFICAR O INDEX

                    $portais_index = Portais::where('id', $portal->id)
                        ->first();


                    if (!empty($portais_index)) {

                        /// OBTÉM O PRÓXIMO INDICE
                        $roleta_usuario_array =  $roleta_usuario->all();


                        $indice = array_search($portais_index->id_usuario, $roleta_usuario_array);


                        if ($indice !== false) {
                            $proximo_indice = ($indice + 1) % count($roleta_usuario_array);
                            $index = $proximo_indice;
                        } else {
                            $index = 0;
                        }
                    } else {

                        $index = 0;
                    }

                    $prazo_usuario_roleta = $portal->prazo_roleta;

                    // Convertendo para objeto Carbon
                    $dataHora = Carbon::parse($prazo_usuario_roleta);

                    /// FAZER A LÓGICA PARA ADICIONAR O DIA ÚTIL 

                    $roleta_usuario_tempo = Roleta_Usuario::where('id_roleta', $portal->id_roleta)
                        ->where('id_usuario', $roleta_usuario[$index])->first();

                    $dataHora->addMinutes($roleta_usuario_tempo->tempo);


                    $portal->id_usuario = $roleta_usuario[$index];
                    $portal->prazo_roleta =  $dataHora;
                    $portal->save();

                    $index = ($index + 1) % $numero_id_usuarios_roleta;
                }
            }
        }
    }

    public function encaminhar_cliente()
    {


        $portais = Portais::where('id', request()->id)->first();


        $empreendimento = Empreendimentos::where('id_empreendimento', $portais->id_empreendimento)->first();

        if(!empty($empreendimento)){

            $id_empreendimento = $empreendimento->id_empreendimento;
            $nome_empreendimento = $empreendimento->nome_empreendimento;

        }else{

            $id_empreendimento = '';
            $nome_empreendimento = '';

        }


        $clientes = new Clientes();
        $clientes->data_criacao = $portais->data_criacao;
        $clientes->data_registro = $portais->data_criacao;
        $clientes->nome_cliente = $portais->nome;
        $clientes->email1_cliente = $portais->email;
        $clientes->email2_cliente = $portais->email;
        $clientes->id_empreendimento = $id_empreendimento;
        $clientes->empreendimento = $nome_empreendimento;
        $clientes->clientes_primarios_id_cliente_primario = $portais->id_cliente_primario;
        $clientes->telefone1_cliente = $portais->telefone;
        $clientes->tipo_telefone1_cliente = 'Whatsapp';
        $clientes->telefone2_cliente = $portais->telefone;
        $clientes->tipo_telefone2_cliente = 'Whatsapp';
        $clientes->save();



        if ($portais) {
            $portais->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Direcionado com sucesso!',
        ]);
    }

    public function encaminhar_usuario_cliente()
    {


        $email_contato = EmailContato::where('id', request()->encaminhar_portal_id)->first();


        $email_contato->id_usuario = request()->encaminhar_usuario;
        $email_contato->save();

        return response()->json([
            'status' => true,
            'message' => 'Alterado com sucesso!',
        ]);
    }
}
