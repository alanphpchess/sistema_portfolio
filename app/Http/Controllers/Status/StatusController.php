<?php

namespace App\Http\Controllers\status;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Convites;
use App\Models\Equipe;
use App\Models\Status;
use App\Models\Empresas;
use App\Mail\ConviteEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\Facades\DataTables;




class StatusController extends Controller
{

    public function index()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();

        if ($bd_users->perfil_usuario != 1) {
            return view('erros_page.404', []);
        }
        
        $cliente_primario = Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;

        $ordens = Status::where('clientes_primarios_id_cliente_primario', $cliente_primario)
            ->select('posicao_status')
            ->distinct()
            ->orderBy('posicao_status', 'asc')
            ->get();

        return view('status.vw-status', [
            'ordens' => $ordens
        ]);
    }

    public function datatable_status()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();
        $db_equipe = DB::table('status')->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->orderBy('posicao_status', 'asc');

        return Datatables::of($db_equipe)
            ->addColumn('usuario', function ($db_equipe) {

                // $users = Users::where('id', $db_equipe->id_usuario)->first();
                // return $users->name;
            })
            ->addColumn('permissao', function ($db_equipe) {


                // if (empty($db_equipe->permissao)) {

                //     return 'Normal';
                // } else {

                //     return $db_equipe->permissao;
                // }
            })
            ->addColumn('cor', function ($data) {
                $cor = $data->cor;
                return '<center><div data-target="' . htmlspecialchars($cor) . '" style="width: 20px; height: 20px; background-color: ' . htmlspecialchars($cor) . '; border: 1px solid #000;"></div></center>';
            })
            ->addColumn('color_original', function ($data) {
                return $data->cor;
            })
            ->addColumn('action', function ($data) {
                $btn_edit_sede = '<button class="bttn-material-flat bttn-xs bttn-success btn-editar-status" data-target="' . $data->id_status . '"> EDITAR</button>';
                $btn_remover_adm = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-status" data-target="' . $data->id_status . '"> EXCLUIR</button>';
                return  $btn_edit_sede . " " . $btn_remover_adm;
            })
            ->rawColumns(['action', 'cor'])
            ->toJson();
    }

    public function editar()
    {
        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;

        $status = Status::where('id_status', request()->id)
            ->where('clientes_primarios_id_cliente_primario', $cliente_primario)->first();


        $ordem_anterior =  Status::where('clientes_primarios_id_cliente_primario', $cliente_primario)
            ->where('posicao_status', request()->ordem)->first();

        if (!empty($ordem_anterior)) {
            $ordem_anterior->posicao_status = $status->posicao_status;
            $ordem_anterior->save();
        }

        if (!empty($status)) {
            $status->titulo_status = request()->nome;
            $status->cor = request()->cor;
            $status->posicao_status = request()->ordem;
            $status->save();

            return response()->json([
                'status' => true,
                'message' => 'Atualizado com sucesso!',
            ]);
        }
    }

    public function adicionar()
    {

        $cliente_primario = Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;

        $bd_status_ult_posicao = Status::where('clientes_primarios_id_cliente_primario', $cliente_primario)
            ->orderBy('posicao_status', 'desc')
            ->first();

        $status = Status::where('titulo_status', request()->nome)->first();


        if (!empty($bd_status_ult_posicao)) {

            $posicao = $bd_status_ult_posicao->posicao_status + 1;
        } else {
            $posicao = 1;
        }


        if (empty(request()->nome)) {
            return response()->json([
                'status' => false,
                'message' => 'Nome está vazio, favor preencher',
            ]);
        }

        if (!empty($status)) {

            return response()->json([
                'status' => false,
                'message' => 'Nome já existe, favor escolher outro!',
            ]);
        } else {

            $status = new Status();
            $status->titulo_status = request()->nome;
            $status->cor = request()->cor;
            $status->clientes_primarios_id_cliente_primario =  $cliente_primario;
            $status->posicao_status = $posicao;
            $status->save();

            return response()->json([
                'status' => true,
                'message' => 'Salvo com sucesso!',
            ]);
        }
    }

    public function excluir()
    {

        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;


        $status = Status::where('id_status', request()->id)
            ->where('clientes_primarios_id_cliente_primario', $cliente_primario);


        if (!empty($status->first())) {

            $status->delete();
        }

        $status = Status::where('clientes_primarios_id_cliente_primario', $cliente_primario)
            ->orderBy('posicao_status', 'asc')->get();

        $ordem  = 1;

        foreach ($status as $status) {

            $status->posicao_status = $ordem;
            $status->save();
            $ordem++;
        }


        return response()->json([
            'status' => true,
            'message' => 'Exclusão efetuada com sucesso!',
        ]);
    }
}
