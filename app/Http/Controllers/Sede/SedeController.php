<?php

namespace App\Http\Controllers\sede;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Convites;
use App\Models\Equipe;
use App\Models\Sedes;
use App\Models\Empresas;
use App\Mail\ConviteEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\Facades\DataTables;




class SedeController extends Controller
{

    function __construct()
    {
    }

    public function index()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        if ($bd_users->perfil_usuario != 1) {
            return view('erros_page.404', []);
        }
        return view('sede.vw-sede', []);
    }


    public function datatable_sede()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();
        $db_equipe = DB::table('sedes')->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);

        return Datatables::of($db_equipe)
            ->addColumn('usuario', function ($db_equipe) {

                // $users = Users::where('id', $db_equipe->id_usuario)->first();
                // return $users->name;
            })
            ->addColumn('permissao', function ($db_equipe) {


                if (empty($db_equipe->permissao)) {

                    return 'Normal';
                } else {

                    return $db_equipe->permissao;
                }
            })
            ->addColumn('action', function ($data) {
                $btn_edit_sede = '<button class="bttn-material-flat bttn-xs bttn-success btn-editar-sede" data-target="' . $data->id_sede . '"> EDITAR</button>';
                $btn_remover_adm = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-sede" data-target="' . $data->id_sede . '"> EXCLUIR</button>';
                return  $btn_edit_sede . " " . $btn_remover_adm;
            })
            ->rawColumns(['action'])
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
        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;
        $sede = Sedes::where('id_sede', request()->id)
            ->where('clientes_primarios_id_cliente_primario', $cliente_primario)->first();


        if (!empty($sede)) {
            $sede->nome_sede = request()->nome;
            $sede->cnpj_sede = request()->cnpj;
            $sede->cep_sede = request()->cep;
            $sede->logradouro_sede = request()->endereco;
            $sede->telefone_sede = request()->telefone;
            $sede->celular_sede = request()->celular;
            $sede->numero_sede = request()->numero;
            $sede->cidade_sede = request()->cidade;
            $sede->estado_sede = request()->estado;
            $sede->save();

            return response()->json([
                'status' => true,
                'message' => 'Atualizado com sucesso!',
            ]);
        }
    }

    public function adicionar()
    {

        $sede = Sedes::where('nome_sede', request()->nome)->first();
        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;

        if(empty(request()->nome)){
            return response()->json([
                'status' => false,
                'message' => 'Nome está vazio, favor preencher',
            ]);
        }

        if (!empty($sede)) {

            return response()->json([
                'status' => false,
                'message' => 'Nome já existe, favor escolher outro!',
            ]);

        } else {

            $sede = new Sedes();
            $sede->nome_sede = request()->nome;
            $sede->clientes_primarios_id_cliente_primario =  $cliente_primario;
            $sede->cnpj_sede = request()->cnpj;
            $sede->cep_sede = request()->cep;
            $sede->logradouro_sede = request()->endereco;
            $sede->telefone_sede = request()->telefone;
            $sede->celular_sede = request()->celular;
            $sede->numero_sede = request()->numero;
            $sede->cidade_sede = request()->cidade;
            $sede->estado_sede = request()->estado;
            $sede->save();

            return response()->json([
                'status' => true,
                'message' => 'Salvo com sucesso!',
            ]);
        }
    }

    public function excluir(){

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $db_portais = sedes::where('id_sede', request()->id)
            ->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);


        if (!empty($db_portais->first())) {

            $db_portais->delete();

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
