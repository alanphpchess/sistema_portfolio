<?php

namespace App\Http\Controllers\equipe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Convites;
use App\Models\Equipe;
use App\Models\Empresas;
use App\Mail\ConviteEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\Facades\DataTables;




class EquipeController extends Controller
{

    function __construct()
    {

    }

    public function index()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();


        return view('equipe.vw-index', []);
    }

    
    public function empresa_view(){

        return view('equipe.vw-empresa', []);

    }

    public function datatable_equipe(){

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $db_users = DB::table('users')->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->orderBy('name', 'asc');

        return Datatables::of($db_users)
        // ->addColumn('usuario', function ($db_equipe) {

        //     $users = Users::where('id', $db_equipe->id_usuario)->first();
        //     return $users->name;
        // })
        ->addColumn('permissao', function ($db_users) {


            if($db_users->perfil_usuario != 1){

                return 'Normal';

            }else{

                return 'Administrador';

            }
        })
        ->addColumn('action', function ($db_users) {

            if($db_users->perfil_usuario != 1){
                $btn_tornar_adm ='<button class="bttn-material-flat bttn-xs bttn-success btn-add-adm" data-target="' . $db_users->id . '"> TORNAR ADM</button>';
                $btn_permissao ='<a href="user/permissao/' . $db_users->id . '"><button class="bttn-material-flat bttn-xs bttn-primary btn-ger-permissao" data-target="' . $db_users->id . '"> PERMISSÃO</button></a>';
                return  $btn_permissao . " " . $btn_tornar_adm ;

            }else{
                $btn_remover_adm ='<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-adm" data-target="' . $db_users->id . '"> REMOVER ADM</button>';
                $btn_permissao ='<a href="user/permissao/' . $db_users->id . '"><button class="bttn-material-flat bttn-xs bttn-primary btn-ger-permissao" data-target="' . $db_users->id . '"> PERMISSÃO</button></a>';
                return  $btn_permissao . " " . $btn_remover_adm ;

            }

        })
            ->rawColumns(['action'])
            ->toJson();
    }

    function tornar_adm(){

        $user = Users::where('id', request()->id)->first();


        if(!empty($user)){

            $user->perfil_usuario = 1;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Adicionado como Administrador!',
            ]);
        }
        
    }

    function remover_adm(){

        $user = Users::where('id', request()->id)->first();

        if(!empty($user)){

            $user->perfil_usuario = 2;
            $user->save();

            return response()->json([
                'status' => true,
                'message' => 'Removido como Administrador!',
            ]);
        }
    }

    function cadastrar_empresa(){

        return view('equipe.vw-cadastrar_empresa', []);
    }

    function inserir_empresa(){
        

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        if(!empty($bd_users->clientes_primarios_id_cliente_primario)){
            return response()->json([
                'status' => false,
                'message' => 'Já existe uma cadastrada!',
            ]);
        }

        $empresa = new Empresas();
        $empresa->nome = request()->nome;
        $empresa->razao = request()->razao;
        $empresa->cnpj= request()->cnpj;
        $empresa->email= request()->email;
        $empresa->telefone= request()->telefone;
        $empresa->celular = request()->celular;
        $empresa->cep = request()->cep;
        $empresa->logradouro = request()->endereco;
        $empresa->numero= request()->numero;
        $empresa->bairro = request()->bairro;
        $empresa->cidade = request()->cidade;
        $empresa->estado = request()->estado;

        if($empresa->save()){
            $bd_users->clientes_primarios_id_cliente_primario = $empresa->id;
            $bd_users->save();
            
            return response()->json([
                'status' => true,
                'message' => 'Empresa criada com sucesso!',
            ]);

        }else{

            return response()->json([
                'status' => false,
                'message' => 'Erro para criar empresa',
            ]);

        }

    }

}
