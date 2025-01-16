<?php

namespace App\Http\Controllers\Empresa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Convites;
use App\Models\Equipe;
use App\Models\Sedes;
use App\Models\Clientes_primarios;
use App\Models\Empresas;
use App\Mail\ConviteEmail;
use App\Models\Grupo_clientes_primarios;
use Illuminate\Support\Facades\Mail;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\Facades\DataTables;




class EmpresaController extends Controller
{

    function __construct() {}

    public function index()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();

        if ($bd_users->perfil_usuario != 1) {
            return view('erros_page.404', []);
        }

        return view('equipe.vw-empresa', []);
    }


    public function datatable_empresa()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();


        $db_empresa = DB::table('clientes_primarios')->where('id_grupo_cliente_primario', $bd_users->id_grupo_cliente_primario);

        return Datatables::of($db_empresa)
            ->addColumn('status', function ($db_empresa) {

                if ($db_empresa->ativo == 0) {

                    return '<span class="text-danger">Desativado</span>';
                } else {
                    return '<span class="text-success">Ativo</span>';
                }
            })
            ->addColumn('permissao', function ($db_empresa) {


                // if (empty($db_empresa->permissao)) {

                //     return 'Normal';
                // } else {

                //     return $db_empresa->permissao;
                // }
            })
            ->addColumn('action', function ($db_empresa) {
                $btn_edit_empresa = '<button class="bttn-material-flat bttn-xs bttn-success btn-editar-empresa" data-target="' . $db_empresa->id_cliente_primario . '"> EDITAR</button>';
                $btn_remover_adm = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-empresa" data-target="' . $db_empresa->id_cliente_primario . '"> EXCLUIR</button>';


                if ($db_empresa->ativo == 0) {

                    $btn_status = '<button class="bttn-material-flat bttn-xs bttn-primary btn-ativar-empresa ml-2" data-target="' . $db_empresa->id_cliente_primario . '"> ATIVAR</button>';
                } else {
                    $btn_status = '';
                }

                return  $btn_edit_empresa . " " . $btn_remover_adm . "  " . $btn_status;
            })
            ->rawColumns(['action', 'status'])
            ->toJson();
    }

    function tornar_adm()
    {

        $equipe = Equipe::where('id', request()->id)->first();
        $user = Users::where('id', request()->id_usuario)->first();


        if (!empty($equipe)) {

            $equipe->permissao = 'Administrador';
            $equipe->save();

            $user->permissao = 'Administrador';
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Adicionado como Administrador!',
            ]);
        }
    }

    public function editar()
    {
        $user =  Users::where('id', auth()->user()->id)->first();

        $bd_cp = Clientes_primarios::where('id_cliente_primario', request()->id)
            ->where('id_grupo_cliente_primario', $user->id_grupo_cliente_primario)->first();


        if (empty($bd_cp)) {
            return response()->json([
                'status' => false,
                'message' => 'Empresa não encontrada!',
            ]);
        }

        if (empty(request()->nome)) {
            return response()->json([
                'status' => false,
                'message' => 'Nome está vazio, favor preencher',
            ]);
        }

        $cnpj = request()->cnpj;

        $cnpj = preg_replace('/\D/', '', $cnpj);

        if (strlen($cnpj) !== 14) {
            return response()->json([
                'status' => false,
                'message' => 'Número CNPJ inválido',
            ]);
        }

        if (!empty($empresa)) {

            return response()->json([
                'status' => false,
                'message' => 'Necessário preencher o campo empresa',
            ]);
        }

        $bd_cp->nome_cliente_primario = request()->nome;
        $bd_cp->celular_cliente_primario = request()->celular;
        $bd_cp->cep_cliente_primario = request()->cep;
        $bd_cp->cidade_cliente_primario = request()->cidade;
        $bd_cp->cnpj_cliente_primario = request()->cnpj;
        $bd_cp->email_cliente_primario = request()->email_cliente_primario;
        $bd_cp->logradouro_cliente_primario = request()->endereco;
        $bd_cp->estado_cliente_primario = request()->estado;
        $bd_cp->numero_cliente_primario = request()->numero;
        $bd_cp->telefone_cliente_primario = request()->telefone;
        $bd_cp->id_grupo_cliente_primario = $user->id_grupo_cliente_primario;


        if ($bd_cp->save()) {

            return response()->json([
                'status' => true,
                'message' => 'Empresa cadastrada com sucesso!',
            ]);
        }
    }

    public function adicionar()
    {

        $user =  Users::where('id', auth()->user()->id)->first();

        $bd_clientes_primarios = Clientes_primarios::where('id_grupo_cliente_primario', $user->id_grupo_cliente_primario)->get();

        if (empty(request()->nome)) {
            return response()->json([
                'status' => false,
                'message' => 'Nome está vazio, favor preencher',
            ]);
        }

        $cnpj = request()->cnpj;

        $cnpj = preg_replace('/\D/', '', $cnpj);

        if (strlen($cnpj) !== 14) {
            return response()->json([
                'status' => false,
                'message' => 'Número CNPJ inválido',
            ]);
        }

        if (!empty($empresa)) {

            return response()->json([
                'status' => false,
                'message' => 'Necessário preencher o campo empresa',
            ]);
        }

        if (!empty($bd_clientes_primarios)) {

            foreach ($bd_clientes_primarios as $bd_cp) {

                if (trim(request()->nome_cliente_primario) == $bd_cp->nome_cliente_primario) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Já existe empresa com esse nome',
                    ]);
                }

                if (trim(request()->nome_cliente_primario) == $bd_cp->nome_cliente_primario) {
                    return response()->json([
                        'status' => false,
                        'message' => 'Já existe empresa com esse nome',
                    ]);
                }

                if (trim(request()->cnpj) == $bd_cp->cnpj_cliente_primario) {
                    return response()->json([
                        'status' => false,
                        'message' => 'CNPJ Já Cadastrado',
                    ]);
                }
            }
        }

        $bd_cp = new Clientes_primarios();
        $bd_cp->nome_cliente_primario = request()->nome;
        $bd_cp->celular_cliente_primario = request()->celular;
        $bd_cp->cep_cliente_primario = request()->cep;
        $bd_cp->cidade_cliente_primario = request()->cidade;
        $bd_cp->cnpj_cliente_primario = request()->cnpj;
        $bd_cp->email_cliente_primario = request()->email_cliente_primario;
        $bd_cp->logradouro_cliente_primario = request()->endereco;
        $bd_cp->estado_cliente_primario = request()->estado;
        $bd_cp->numero_cliente_primario = request()->numero;
        $bd_cp->celular_cliente_primario = request()->telefone;
        $bd_cp->id_grupo_cliente_primario = $user->id_grupo_cliente_primario;
        $bd_cp->save();

        $bd_gp_cp = new Grupo_clientes_primarios();
        $bd_gp_cp->id_cliente_primario = $bd_cp->id_cliente_primario;
        $bd_gp_cp->nome_cliente_primario = $bd_cp->celular_cliente_primario;
        $bd_gp_cp->id_grupo = $bd_cp->id_grupo_cliente_primario;
        $bd_gp_cp->nome_cliente_primario = $bd_cp->nome_cliente_primario;
        $bd_gp_cp->id_usuario =  $user->id;
        $bd_gp_cp->save();

        return response()->json([
            'status' => true,
            'message' => 'Salvo com sucesso!',
        ]);
    }

    public function ativar_empresa()
    {

        $user =  Users::where('id', auth()->user()->id)->first();

        $cliente_primario_anterior = $user->clientes_primarios_id_cliente_primario;

        Users::where('clientes_primarios_id_cliente_primario', $user->clientes_primarios_id_cliente_primario)->where('id', auth()->user()->id)
            ->update([
                'clientes_primarios_id_cliente_primario' => request()->id,
                'id_grupo_cliente_primario' => $user->id_grupo_cliente_primario
            ]);

        Clientes_primarios::where('id_cliente_primario', $cliente_primario_anterior)->update(
            [
                'ativo' => 0
            ]
        );

        Clientes_primarios::where('id_cliente_primario', request()->id)->update(
            [
                'ativo' => 1
            ]
        );

        return response()->json([
            'status' => true,
            'message' => 'Atualizado com sucesso!',
        ]);
    }
    public function excluir()
    {

        $user =  Users::where('id', auth()->user()->id)->first();

        $bd_cp = Clientes_primarios::where('id_grupo_cliente_primario', $user->id_grupo_cliente_primario);

        if ($bd_cp->count() == 1) {

            return response()->json([
                'status' => true,
                'message' => 'É obrigatório deixar apenas 1 empresa no sistema!',
            ]);
        }

        $bd_cp =  $bd_cp->where('id_cliente_primario', request()->id)->first();


        if (!empty($bd_cp)) {

            $bd_cp->delete();

            Grupo_clientes_primarios::where('id_cliente_primario', request()->id)->first();


            if ($user->clientes_primarios_id_cliente_primario == request()->id) {

                Users::where('clientes_primarios_id_cliente_primario', $user->clientes_primarios_id_cliente_primario)
                    ->update([
                        'clientes_primarios_id_cliente_primario' => '',
                        'id_grupo_cliente_primario' => ''
                    ]);
            }


            return response()->json([
                'status' => true,
                'message' => 'Exclusão efetuada com sucesso!',
            ]);
        }
    }

    function remover_adm()
    {

        $equipe = Equipe::where('id', request()->id)->first();
        $user = Users::where('id', request()->id_usuario)->first();


        if (!empty($equipe)) {

            $equipe->permissao = '';
            $equipe->save();

            $user->permissao = '';
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Removido como Administrador!',
            ]);
        }
    }

    function cadastrar_empresa()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();

        if ($bd_users->perfil_usuario != 1) {
            return view('erros_page.404', []);
        }


        return view('equipe.vw-cadastrar_empresa', []);
    }

    function inserir_empresa()
    {


        $bd_users =  Users::where('id', auth()->user()->id)->first();

        if (!empty($bd_users->clientes_primarios_id_cliente_primario)) {
            return response()->json([
                'status' => false,
                'message' => 'Já existe uma cadastrada!',
            ]);
        }

        $empresa = new Empresas();
        $empresa->nome = request()->nome;
        $empresa->razao = request()->razao;
        $empresa->cnpj = request()->cnpj;
        $empresa->email = request()->email;
        $empresa->telefone = request()->telefone;
        $empresa->celular = request()->celular;
        $empresa->cep = request()->cep;
        $empresa->logradouro = request()->endereco;
        $empresa->numero = request()->numero;
        $empresa->bairro = request()->bairro;
        $empresa->cidade = request()->cidade;
        $empresa->estado = request()->estado;

        if ($empresa->save()) {
            $bd_users->clientes_primarios_id_cliente_primario = $empresa->id;
            $bd_users->save();

            return response()->json([
                'status' => true,
                'message' => 'Empresa criada com sucesso!',
            ]);
        } else {

            return response()->json([
                'status' => false,
                'message' => 'Erro para criar empresa',
            ]);
        }
    }
}
