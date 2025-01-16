<?php

namespace App\Http\Controllers\contratos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ficha_compra;
use App\Models\Equipe;
use App\Mail\ConviteEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\Facades\DataTables;




class CadastroComprasController extends Controller
{

    function __construct()
    {

    }

    public function index()
    {
        return view('contratos.cadastro_compras.vw-index', []);
    }


    public function datatable(){

        $bd_users =  Users::where('id', auth()->user()->id)->first();
        $db = DB::table('ficha_compra')->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);

        return Datatables::of($db)
        ->addColumn('nome_corretor', function ($db) {

            $users = Users::where('id', $db->usuarios_id_usuario)->first();

            if(!empty($users )){
                return $users->name;
            }
           
        })
        ->addColumn('action', function ($data) {
            $btn_edit = '<button class="bttn-material-flat bttn-xs bttn-success btn-editar" data-target="' . $data->id_form . '"> EDITAR</button>';
            $btn_remover_adm = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir" data-target="' . $data->id_form . '"> EXCLUIR</button>';
            return  $btn_edit . " " . $btn_remover_adm;
        })
            ->rawColumns(['action'])
            ->toJson();
    }


    public function adicionar(){
        return view('contratos.cadastro_compras.vw-add', [
            'cliente' => ''
        ]);
    }


}
