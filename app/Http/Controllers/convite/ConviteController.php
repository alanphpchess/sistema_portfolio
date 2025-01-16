<?php

namespace App\Http\Controllers\convite;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Convites;
use App\Models\Equipe;
use App\Mail\ConviteEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\Facades\DataTables;
use App\Models\Sedes;




class ConviteController extends Controller
{

    function __construct()
    {

    }

    public function index()
    {

        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;
        $sedes = Sedes::where('clientes_primarios_id_cliente_primario', $cliente_primario)->get();


        return view('convite.vw-index', [
            'sedes' => $sedes
        ]);

    }

    public function enviar_convite(){

        $email = request()->email;

        $users = Users::where('email', $email)->first();

        if(empty($users)){

            return response()->json([
                'status' => false,
                'message' => 'E-mail não cadastrado!',
            ]);

        }

        $convite = Convites::where('email', $email)->first();

        if(!empty($convite)){
            return response()->json([
                'status' => true,
                'message' => 'E-mail já enviado!',
            ]);
        }
        $bd_users_conv =  Users::where('id', auth()->user()->id)->first();

        $codigo_validacao = rand(10000, 2147483647);
        $convite = new Convites();
        $convite->data  = date('Y-m-d H:i:s');
        $convite->status = 'Aguardando Aceitação';
        $convite->email = $email;
        $convite->id_cliente = $bd_users_conv->clientes_primarios_id_cliente_primario;
        $convite->id_usuario_convidado = $users->id;
        $convite->id_usuario_env_email = $bd_users_conv->id;
        $convite->codigo_validacao = $codigo_validacao;
        $convite->save();

        $url = 'https://Sistematecnologia.com.br/email/convite/validacao/'. $codigo_validacao;


        $data = [
            'url_ativacao' => $url,
            'message' => 'Olá, segue o link do convite de e-mail abaixo: '
        ];
        Mail::to($email)->send(new conviteEmail($data));

        return response()->json([
            'status' => true,
            'message' => 'Convite enviado com sucesso!',
        ]);
    }

    public function validacao_convite($codigo_validacao){

        $convite = Convites::where('codigo_validacao', $codigo_validacao)->first();

        $equipe = Equipe::where('id_usuario', $convite->id_usuario_convidado)
                ->where('id_user_adm', $convite->id_usuario_env_email)->first();

        if(empty($equipe)){
            $equipe = new Equipe();
            $equipe->id_usuario = $convite->id_usuario_convidado;
            $equipe->id_cliente = $convite->id_cliente;
            $equipe->ativo = true;
            $equipe->id_user_adm = $convite->id_usuario_env_email;
            $equipe->save();
        }

        $convite->status = 'Aceito';
        $convite->save();

    }

    public function datatable_convite(){

   
        $bd_users =  Users::where('id', auth()->user()->id)->first();


        $db_convite = DB::table('convites')->where('id_cliente', $bd_users->clientes_primarios_id_cliente_primario);


        return Datatables::of($db_convite)
        ->addColumn('id_usuario_convidado', function ($db_convite) {

            $users = Users::where('id', $db_convite->id_usuario_convidado)->first();
            return $users->name;
        })
        ->addColumn('status', function ($db_convite) {

            if($db_convite->status == 'Aguardando Aceitação'){

                return '<div style="color:green">Aguardando Aceitação</div>';

            }else{
                return '<div style="color:blue">Aceito</div>';
            }
        })
            ->rawColumns(['id_usuario_convidado','status'])
            ->toJson();
    }

}
