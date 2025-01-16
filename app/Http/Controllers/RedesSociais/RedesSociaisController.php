<?php

namespace App\Http\Controllers\redessociais;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empreendimentos;
use App\Models\Permissoes;
use App\Functions\Validacao;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\Facades\DataTables;
use App\Models\Users;
use App\Models\Clientes;
use Illuminate\Support\Str;
use App\Models\Img_empreendimentos;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Cat_pasta_emp;
use App\Models\Pastas;
use App\Models\Fontes;
use App\Models\Redes_Sociais;
use App\Models\tags;



class RedesSociaisController extends Controller
{

    function __construct() {}

    public function index()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $permissoes = Permissoes::where('id_usuario', $bd_users->id)->get();
        $bd_users_todos = Users::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();

        $lista_permissao = [];
        foreach ($permissoes as $permissao) {
            $lista_permissao[$permissao->nome] = $permissao->ativo;
        }
        if ($bd_users->permissao == 'Administrador') {
            $user_admin = 1;
        } else {
            $user_admin = 0;
        }

        /// FIM PERMISSÕES

        return view('redes_sociais.vw-redes_sociais', [
            'permissoes' => $lista_permissao,
            'user_admin' => $user_admin,
            'user_todos' => $bd_users_todos
        ]);
    }

    public function adicionar()
    {

        return view('redes_sociais.vw-redes_sociais');
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

    public function datatable_redes_sociais()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();


        $db_emails = DB::table('email_contato')
            ->where('tipo', 1)
            ->where('id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);



        return Datatables::of($db_emails)

            ->addColumn('nome_empreendimento', function ($data) {
                $empreendimento = Empreendimentos::where('id_empreendimento', $data->id_empreendimento)->first();

                if (!empty($empreendimento->nome_empreendimento)) {
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
                $btn_excluir = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-redes_sociais" data-target="' . $data->id . '"><i class="ri-delete-bin-5-line"></i> Excluir</button>';
                // } else if (!empty($permissoes_excluir)) {

                //     if ($permissoes_excluir->ativo == 'true' || $bd_users->permissao == 'Administrador') {
                //         $btn_excluir = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-redes_sociais" data-target="' . $data->id . '"><i class="ri-delete-bin-5-line"></i> Excluir</button>';
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
            ->rawColumns(['action', 'img_principal', 'numeros_imgs', 'arquivos'])
            ->toJson();
    }


    public function excluir()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $db_redes_sociais = Redes_Sociais::where('id', request()->id)
            ->where('id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);

        if (!empty($db_redes_sociais->first())) {

            $db_redes_sociais->delete();

            return response()->json([
                'status' => true,
                'message' => 'Exclusão efetuada com sucesso!',
            ]);
        }
    }

    public function encaminhar_cliente()
    {


        $rd = Redes_Sociais::where('id', request()->id)->first();

        $empreendimento = Empreendimentos::where('id_empreendimento', $rd->id_empreendimento)->first();


        $clientes = new Clientes();
        $clientes->data_criacao = $rd->data_criacao;
        $clientes->data_registro = $rd->data_criacao;
        $clientes->nome_cliente = $rd->nome;
        $clientes->email1_cliente = $rd->email;

        if (!empty($empreendimento)) {

            $clientes->id_empreendimento =  $empreendimento->id_empreendimento;
            $clientes->empreendimento = $empreendimento->nome_empreendimento;

        } 

        $clientes->clientes_primarios_id_cliente_primario = $rd->id_cliente_primario;
        $clientes->telefone1_cliente = $rd->telefone;
        $clientes->tipo_telefone1_cliente = 'Whatsapp';
        $clientes->telefone2_cliente = $rd->telefone;
        $clientes->tipo_telefone2_cliente = 'Whatsapp';
        $clientes->save();



        if ($rd) {
            $rd->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Direcionado com sucesso!',
        ]);
    }

    public function encaminhar_usuario_cliente()
    {


        $email_contato = Redes_Sociais::where('id', request()->encaminhar_portal_id)->first();


        $email_contato->id_usuario = request()->encaminhar_usuario;
        $email_contato->save();

        return response()->json([
            'status' => true,
            'message' => 'Alterado com sucesso!',
        ]);
    }
}
