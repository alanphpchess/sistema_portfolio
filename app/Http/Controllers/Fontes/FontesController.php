<?php

namespace App\Http\Controllers\fontes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Convites;
use App\Models\Equipe;
use App\Models\Fontes;
use App\Models\Empresas;
use App\Mail\ConviteEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\Facades\DataTables;




class FontesController extends Controller
{

    public function index()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();

        if ($bd_users->perfil_usuario != 1) {
            return view('erros_page.404', []);
        }

        return view('fontes.vw-fontes', []);
    }

    public function datatable_fontes()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();
        $db_equipe = DB::table('fontes')->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);

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
                $btn_edit_sede = '<button class="bttn-material-flat bttn-xs bttn-success btn-editar-fontes" data-target="' . $data->id_fonte . '"> EDITAR</button>';
                $btn_remover_adm = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-fontes" data-target="' . $data->id_fonte . '"> EXCLUIR</button>';
                return  $btn_edit_sede . " " . $btn_remover_adm;
            })
            ->rawColumns(['action'])
            ->toJson();
    }

    public function editar()
    {
        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;
        $fontes = Fontes::where('id_fonte', request()->id)
            ->where('clientes_primarios_id_cliente_primario', $cliente_primario)->first();



        if (!empty($fontes)) {
            $fontes->titulo_fonte = request()->nome;
            $fontes->save();

            return response()->json([
                'status' => true,
                'message' => 'Atualizado com sucesso!',
            ]);
        }
    }

    public function adicionar()
    {

        $fontes = Fontes::where('titulo_fonte', request()->nome)->first();
        $cliente_primario = Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;



        if (empty(request()->nome)) {
            return response()->json([
                'status' => false,
                'message' => 'Nome está vazio, favor preencher',
            ]);
        }

        if (!empty($fontes)) {

            return response()->json([
                'status' => false,
                'message' => 'Nome já existe, favor escolher outro!',
            ]);
        } else {

            $fontes = new Fontes();
            $fontes->titulo_fonte = request()->nome;
            $fontes->clientes_primarios_id_cliente_primario =  $cliente_primario;
            $fontes->save();

            return response()->json([
                'status' => true,
                'message' => 'Salvo com sucesso!',
            ]);
        }
    }

    public function excluir()
    {

        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;


        $fontes = Fontes::where('id_fonte', request()->id)
            ->where('clientes_primarios_id_cliente_primario', $cliente_primario);


        if (!empty($fontes->first())) {

            $fontes->delete();

            return response()->json([
                'status' => true,
                'message' => 'Exclusão efetuada com sucesso!',
            ]);
        }
    }
}
