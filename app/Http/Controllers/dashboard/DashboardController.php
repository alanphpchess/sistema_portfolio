<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Imoveis;
use App\Models\Dashboard;
use App\Models\Dashboard_itens;
use App\Models\Dashboard_filtro;
use App\Models\Users;
use Illuminate\Support\Facades\Blade;
use App\Models\Clientes;
use App\Models\Empreendimentos;
use App\Models\Status;
use App\Models\Tags;
use App\Models\Fontes;
use App\Models\Status_evolucao;
use Illuminate\Support\Facades\DB;


class DashboardController extends Controller
{

    function __construct() {}

    public function index()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $dashboard_itens =  Dashboard_itens::with('dashboard')->where('id_usuario', $bd_users->id)->orderBy('ordem', 'asc')->get();

        $dashboards = Dashboard::orderBy('id', 'asc')->get();

        $dashboard_filtro = Dashboard_filtro::with('Empreendimentos', 'Users', 'Fonte', 'Status')->where('id_usuario', $bd_users->id)->first();

        $ids_dashboard_list_modal = [];

        foreach ($dashboard_itens as $dashboard_item) {

            $ids_dashboard_list_modal[] = $dashboard_item->id_dashboard;
        }

        /// LISTA CORRETORES
        $corretores =  Users::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->orderBy('name', 'asc')->get();

        /// TOTAL DE EMPREENDIMENTOS
        $total_empreendimentos = Empreendimentos::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get()->count();

        /// TOTAL DE CLIENTES
        $total_clientes = Clientes::select('nome_cliente')->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);

        if ($bd_users->perfil_usuario != 1) {
            $total_clientes = $total_clientes->where('usuarios_id_usuario', auth()->user()->id);
        }

        $clientes = Clientes::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);

        if (!empty($dashboard_filtro)) {

            if (!empty($dashboard_filtro->filtro_data_inicio) && !empty($dashboard_filtro->filtro_data_fim)) {

                $total_clientes = $total_clientes->whereBetween('data_registro', [
                    $dashboard_filtro->filtro_data_inicio,
                    $dashboard_filtro->filtro_data_fim
                ]);
            }

            if (!empty($dashboard_filtro->filtro_corretor)) {
                $total_clientes =  $total_clientes->where('usuarios_id_usuario', $dashboard_filtro->filtro_corretor);
            }

            if (!empty($dashboard_filtro->filtro_fonte)) {
                $total_clientes =  $total_clientes->where('fontes_id_fonte', $dashboard_filtro->filtro_fonte);
            }


            if (!empty($dashboard_filtro->filtro_empreendimento)) {
                $total_clientes =  $total_clientes->where('id_empreendimento', $dashboard_filtro->filtro_empreendimento);
            }

            if (!empty($dashboard_filtro->filtro_status)) {
                $total_clientes =  $total_clientes->where('clientes.status_id_status', $dashboard_filtro->filtro_status);
            }
        }


        $total_clientes = $total_clientes->distinct()->orderBy('nome_cliente', 'asc')->get();



        /// EQUIPE
        $equipe = Users::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->orderBy('name', 'asc')->get();





        if ($bd_users->perfil_usuario != 1) {

            $status = Status::with('status_evolucao', 'clientes')
                ->select('status.id_status', 'titulo_status', 'status.cor', 'clientes.status_id_status', 'clientes.usuarios_id_usuario', DB::raw('count(distinct clientes.id_cliente) as quantidade'))
                ->join('evolucao_status', 'status.id_status', '=', 'evolucao_status.id_status')
                ->join('clientes', 'clientes.status_id_status', '=', 'status.id_status')
                ->where('clientes.usuarios_id_usuario', auth()->user()->id);
        } else {
            $status = Status::with('status_evolucao', 'clientes')
                ->select('titulo_status', DB::raw('COUNT(*) as quantidade'))
                ->join('evolucao_status', 'status.id_status', '=', 'evolucao_status.id_status')
                ->join('clientes', 'evolucao_status.id_cliente', '=', 'clientes.id_cliente');
        }


        if (!empty($dashboard_filtro)) {

            if (!empty($dashboard_filtro->filtro_data_inicio) && !empty($dashboard_filtro->filtro_data_fim)) {

                $status = $status->whereBetween('clientes.data_registro', [
                    $dashboard_filtro->filtro_data_inicio,
                    $dashboard_filtro->filtro_data_fim
                ]);
            }

            if (!empty($dashboard_filtro->filtro_corretor)) {
                $status =  $status->where('clientes.usuarios_id_usuario', $dashboard_filtro->filtro_corretor);
            }

            if (!empty($dashboard_filtro->filtro_fonte)) {
                $status =  $status->where('clientes.fontes_id_fonte', $dashboard_filtro->filtro_fonte);
            }


            if (!empty($dashboard_filtro->filtro_empreendimento)) {
                $status =  $status->where('clientes.id_empreendimento', $dashboard_filtro->filtro_empreendimento);
            }

            if (!empty($dashboard_filtro->filtro_status)) {
                $status =  $status->where('status.id_status', $dashboard_filtro->filtro_status);
            }
        }

        $status = $status->where('status.clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)
            ->groupBy('status.id_status', 'titulo_status', 'status.cor', 'clientes.status_id_status', 'clientes.usuarios_id_usuario')
            ->get();



        $tags =  Tags::select('titulo', DB::raw('COUNT(*) as quantidade'))
            ->join('cliente_tags', 'tags.id', '=', 'cliente_tags.tag_id')
            ->where('cliente_primario_id', $bd_users->clientes_primarios_id_cliente_primario)
            ->join('clientes', 'cliente_tags.cliente_id', '=', 'clientes.id_cliente');

        if ($bd_users->perfil_usuario != 1) {
            $tags =  $tags->where('clientes.usuarios_id_usuario', auth()->user()->id);
        }


        if (!empty($dashboard_filtro)) {

            if (!empty($dashboard_filtro->filtro_data_inicio) && !empty($dashboard_filtro->filtro_data_fim)) {

                $tags = $tags->whereBetween('clientes.data_registro', [
                    $dashboard_filtro->filtro_data_inicio,
                    $dashboard_filtro->filtro_data_fim
                ]);
            }

            if (!empty($dashboard_filtro->filtro_corretor) && $bd_users->perfil_usuario != 3) {
                $tags =  $tags->where('clientes.usuarios_id_usuario', $dashboard_filtro->filtro_corretor);
            }

            if (!empty($dashboard_filtro->filtro_fonte)) {
                $tags =  $tags->where('clientes.fontes_id_fonte', $dashboard_filtro->filtro_fonte);
            }


            if (!empty($dashboard_filtro->filtro_empreendimento)) {
                $tags =  $tags->where('clientes.id_empreendimento', $dashboard_filtro->filtro_empreendimento);
            }

            if (!empty($dashboard_filtro->filtro_status)) {
                $tags =  $tags->where('clientes.status_id_status', $dashboard_filtro->filtro_status);
            }
        }

        $tags = $tags->groupBy('titulo')->get();



        $atendimentos_usuarios = Clientes::with('Usuarios')
            ->select('users.name', DB::raw('COUNT(*) as quantidade'))
            ->join('users', 'clientes.usuarios_id_usuario', '=', 'users.id');

        if ($bd_users->perfil_usuario != 1) {
            $atendimentos_usuarios =  $atendimentos_usuarios->where('clientes.usuarios_id_usuario', auth()->user()->id);
        }

        if (!empty($dashboard_filtro)) {

            if (!empty($dashboard_filtro->filtro_data_inicio) && !empty($dashboard_filtro->filtro_data_fim)) {

                $atendimentos_usuarios = $atendimentos_usuarios->whereBetween('data_registro', [
                    $dashboard_filtro->filtro_data_inicio,
                    $dashboard_filtro->filtro_data_fim
                ]);
            }

            if (!empty($dashboard_filtro->filtro_corretor) && $bd_users->perfil_usuario != 3) {

                $atendimentos_usuarios =  $atendimentos_usuarios->where('clientes.usuarios_id_usuario', $dashboard_filtro->filtro_corretor);
            }

            if (!empty($dashboard_filtro->filtro_fonte)) {
                $atendimentos_usuarios =  $atendimentos_usuarios->where('clientes.fontes_id_fonte', $dashboard_filtro->filtro_fonte);
            }


            if (!empty($dashboard_filtro->filtro_empreendimento)) {
                $atendimentos_usuarios =  $atendimentos_usuarios->where('clientes.id_empreendimento', $dashboard_filtro->filtro_empreendimento);
            }

            if (!empty($dashboard_filtro->filtro_status)) {
                $atendimentos_usuarios =  $atendimentos_usuarios->where('clientes.status_id_status', $dashboard_filtro->filtro_status);
            }
        }

        $atendimentos_usuarios =  $atendimentos_usuarios->where('users.clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)
            ->groupBy('users.name')
            ->get();


        $anoDesejado = 2024;

        $clientesPorMesStatus = Clientes::selectRaw('MONTH(data_registro) as mes, status.titulo_status as titulo_status, clientes.status_id_status, COUNT(*) as total')
            ->join('status', 'clientes.status_id_status', '=', 'status.id_status')
            ->whereYear('data_registro', $anoDesejado)
            ->where('clientes.clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);


        if ($bd_users->perfil_usuario != 1) {
            $clientesPorMesStatus =  $clientesPorMesStatus->where('clientes.usuarios_id_usuario', auth()->user()->id);
        }

        if (!empty($dashboard_filtro)) {

            if (!empty($dashboard_filtro->filtro_data_inicio) && !empty($dashboard_filtro->filtro_data_fim)) {

                $clientesPorMesStatus = $clientesPorMesStatus->whereBetween('data_registro', [
                    $dashboard_filtro->filtro_data_inicio,
                    $dashboard_filtro->filtro_data_fim
                ]);
            }

            if (!empty($dashboard_filtro->filtro_corretor)  && $bd_users->perfil_usuario != 3) {
                $clientesPorMesStatus =  $clientesPorMesStatus->where('clientes.usuarios_id_usuario', $dashboard_filtro->filtro_corretor);
            }

            if (!empty($dashboard_filtro->filtro_fonte)) {
                $clientesPorMesStatus =  $clientesPorMesStatus->where('clientes.fontes_id_fonte', $dashboard_filtro->filtro_fonte);
            }


            if (!empty($dashboard_filtro->filtro_empreendimento)) {
                $clientesPorMesStatus =  $clientesPorMesStatus->where('clientes.id_empreendimento', $dashboard_filtro->filtro_empreendimento);
            }

            if (!empty($dashboard_filtro->filtro_status)) {
                $clientesPorMesStatus =  $clientesPorMesStatus->where('clientes.status_id_status', $dashboard_filtro->filtro_status);
            }
        }

        $clientesPorMesStatus =  $clientesPorMesStatus->groupBy('mes', 'clientes.status_id_status', 'titulo_status')->orderBy('mes', 'asc')->get();

        $mesesPortugues = [
            1 => 'Janeiro',
            2 => 'Fevereiro',
            3 => 'Março',
            4 => 'Abril',
            5 => 'Maio',
            6 => 'Junho',
            7 => 'Julho',
            8 => 'Agosto',
            9 => 'Setembro',
            10 => 'Outubro',
            11 => 'Novembro',
            12 => 'Dezembro',
        ];


        $leadsPorMesStatus = $clientesPorMesStatus->groupBy('mes')->map(function ($items, $mes) use ($anoDesejado, $mesesPortugues) {

            $statusCount = [];
            $totalGeral = 0;

            foreach ($items as $item) {
                $statusCount[] = [
                    'total' => $item->total,
                    'id_status' => $item->status_id_status,
                    'nome_status' => $item->titulo_status,
                ];
                $totalGeral += $item->total;
            }

            return [
                'mes' => $mesesPortugues[$mes],
                'status_totais' => $statusCount,
                'total' => $totalGeral,
            ];
        });



        $fontes = Fontes::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->orderBy('titulo_fonte', 'asc')->get();

        $empreendimentos = Empreendimentos::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->orderBy('nome_empreendimento', 'asc')->get();

        $bd_status = Status::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)
            ->orderBy('titulo_status', 'asc')
            ->get();



        return view('admin', [
            'dashboard_itens' => $dashboard_itens,
            'total_empreendimentos' => $total_empreendimentos,
            'total_clientes' => $total_clientes->count(),
            'clientes' => $total_clientes,
            'total_equipe' => $equipe->count(),
            'equipe' => $equipe,
            'status' => $status,
            'atendimentos_usuarios' => $atendimentos_usuarios,
            'tags' => $tags,
            'leads' => $leadsPorMesStatus,
            'dashboards' => $dashboards,
            'ids_dashboard_list_modal' => $ids_dashboard_list_modal,
            'corretores' => $corretores,
            'fontes' => $fontes,
            'empreendimentos' => $empreendimentos,
            'dashboard_filtro' => $dashboard_filtro,
            'bd_status' => $bd_status,
            'perfil_usuario' => $bd_users->perfil_usuario
        ]);
    }


    ///? OBTÉM TODA AS LISTA DO DASHBOARD E INSERI NO MODAL 
    //? DE ADD/EDITAR DASHBOARD

    public function get_list_item() {}

    public function salvar_item()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $dashboard_itens = Dashboard_itens::where('id_usuario', $bd_users->id)->get();

        if (!$dashboard_itens->isEmpty()) {

            foreach ($dashboard_itens as $item) {
                $item->delete();
            }
        }

        $i = 1;

        foreach (request()->itens as $item_dashboard) {
            $dashboard_itens = new Dashboard_itens;
            $dashboard_itens->id_usuario = $bd_users->id;
            $dashboard_itens->id_dashboard = $item_dashboard;
            $dashboard_itens->ordem = $i;
            $dashboard_itens->save();

            $i++;
        }

        return response()->json([
            'status' => true,
            'message' => 'Atualizado com sucesso!',
        ]);
    }

    public function salvar_ordem_dash()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();
        $i = 1;

        foreach (request()->dashboardIds as $dashboard_id) {

            $dashboard_itens = Dashboard_itens::where('id_usuario', $bd_users->id)->where('id_dashboard', $dashboard_id)->first();
            $dashboard_itens->ordem = $i;
            $dashboard_itens->save();

            $i++;
        }
    }

    public function dashboard_filtro()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $dashboard_filtro = Dashboard_filtro::where('id_usuario', $bd_users->id)->first();

        if (empty($dashboard_filtro)) {
            $dashboard_filtro = new Dashboard_filtro();
        }

        $dashboard_filtro->id_usuario = $bd_users->id;

        if (!empty(request()->data_inicio) && !empty(request()->data_fim)) {

            $dashboard_filtro->filtro_data_inicio = request()->data_inicio;
            $dashboard_filtro->filtro_data_fim = request()->data_fim;
        } else {

            $dashboard_filtro->filtro_data_inicio = null;
            $dashboard_filtro->filtro_data_fim = null;
        }

        if (!empty(request()->corretor_id)) {

            $dashboard_filtro->filtro_corretor = request()->corretor_id;
        } else {

            $dashboard_filtro->filtro_corretor = null;
        }

        if (!empty(request()->fonte_id)) {

            $dashboard_filtro->filtro_fonte = request()->fonte_id;
        } else {

            $dashboard_filtro->filtro_fonte = null;
        }

        if (!empty(request()->empreendimento_id)) {

            $dashboard_filtro->filtro_empreendimento = request()->empreendimento_id;
        } else {

            $dashboard_filtro->filtro_empreendimento = null;
        }

        if (!empty(request()->status_id)) {

            $dashboard_filtro->filtro_status = request()->status_id;
        } else {

            $dashboard_filtro->filtro_status = null;
        }


        $dashboard_filtro->save();

        return response()->json([
            'status' => true,
            'message' => 'Atualizado com sucesso!',
        ]);
    }
}
