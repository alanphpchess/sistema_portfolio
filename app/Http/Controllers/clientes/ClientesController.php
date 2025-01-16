<?php

namespace App\Http\Controllers\clientes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clientes;
use App\Models\Permissoes;
use App\Functions\Validacao;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\Facades\DataTables;
use App\Models\Users;
use Illuminate\Support\Str;
use App\Models\Img_clientes;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Cat_pasta_clientes;
use App\Models\Cli_gp_sedes_emp;
use App\Models\Pastas;
use App\Models\Empreendimentos;
use App\Models\Sedes;
use App\Models\Tags;
use App\Models\Tags_clientes;
use App\Models\Status_evolucao;
use App\Models\Status;
use App\Models\Alertas;
use App\Models\Contatos_realizados;
use App\Models\Fontes;
use App\Models\Grupo_sede;
use App\Models\Filtro_dt_clientes;
use App\Models\ProvedorContato;
use Barryvdh\Snappy\Facades\SnappyPdf as SnappyPDF;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;



class ClientesController extends Controller
{


    function __construct()
    {
        ini_set('memory_limit', '256M');
        date_default_timezone_set('America/Sao_Paulo');
        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese');
    }

    public function index()
    {
        

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $filtro_clientes = Filtro_dt_clientes::with('Usuarios', 'Fontes')->where('id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();

        // dd($filtro_clientes );

        $permissoes = Permissoes::where('id_usuario', $bd_users->id)->where('ativo', 'true')->get();

        $lista_permissao = [];
        foreach ($permissoes as $permissao) {
            $lista_permissao[] = $permissao->nome;
        }

        $lista_empreendimentos = Empreendimentos::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)
            ->get();

        $lista_fontes = Fontes::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)
            ->get();

        $lista_corretores = Clientes::with('Usuarios')->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);


        if ($bd_users->perfil_usuario != 1) {
            $lista_corretores = $lista_corretores->where('usuarios_id_usuario', auth()->user()->id);
        }

        $lista_corretores = $lista_corretores->select('usuarios_id_usuario')->distinct()->get();

        $lista_status = Status::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)
            ->get();

        $clientes_total = Clientes::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);

        if ($bd_users->perfil_usuario != 1) {
            $clientes_total = $clientes_total->where('usuarios_id_usuario', auth()->user()->id);
        }

        $clientes_total = $clientes_total->count();

        $status = Status::with('status_evolucao', 'clientes')
        ->select(
            'status.id_status', 
            'status.titulo_status', 
            'status.cor', 
            DB::raw('COUNT(DISTINCT clientes.id_cliente) AS quantidade')
        )
        ->join('evolucao_status', 'status.id_status', '=', 'evolucao_status.id_status')
        ->join('clientes', 'clientes.status_id_status', '=', 'status.id_status')
        ->where('clientes.clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);
    
    if ($bd_users->perfil_usuario != 1) {
        $status = $status->where('clientes.usuarios_id_usuario', auth()->user()->id);
    }
    
    $status = $status->groupBy(
            'status.id_status', 
            'status.titulo_status', 
            'status.cor'
        )
        ->orderBy('status.posicao_status')
        ->get();

    

        foreach ($status as $st) {

            $clientes = Clientes::where('status_id_status', $st->id_status)->orderby('id_cliente', 'desc')->where(function ($query) {
                $query->whereNull('order_kanban')
                    ->orWhere('order_kanban', 0);
            });

            if ($bd_users->perfil_usuario != 1) {
                $clientes = $clientes->where('usuarios_id_usuario', auth()->user()->id);
            }

            $clientes = $clientes->get();

            $order_kanban = 1;

            $cliente_ultima_order_kanban = Clientes::where('status_id_status', $st->id_status)
                ->where('order_kanban', '!=', 0)
                ->whereNotNull('order_kanban')
                ->orderby('order_kanban', 'asc');

            if ($bd_users->perfil_usuario != 1) {
                $cliente_ultima_order_kanban = $cliente_ultima_order_kanban->where('usuarios_id_usuario', auth()->user()->id);
            }

            $cliente_ultima_order_kanban = $cliente_ultima_order_kanban->first();

            if (!empty($cliente_ultima_order_kanban)) {

                $order_kanban =  $cliente_ultima_order_kanban->order_kanban + 1;
            }

            foreach ($clientes as $cliente) {

                $cliente->order_kanban = $order_kanban;
                $cliente->save();

                $order_kanban++;
            }
        }

        $status_cliente = Clientes::whereNotNull('status_id_status');

        if ($bd_users->perfil_usuario != 1) {
            $status_cliente  = $status_cliente->where('usuarios_id_usuario', auth()->user()->id);
        }

        $status_cliente =  $status_cliente->count();


        $clientesSemStatus = Clientes::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->where(function ($query) {
            $query->whereNull('status_id_status')
                ->orWhere('status_id_status', 0);
        });




        if ($bd_users->perfil_usuario != 1) {
            $clientesSemStatus = $clientesSemStatus->where('usuarios_id_usuario', auth()->user()->id);
        }

        $clientesSemStatus = $clientesSemStatus->count();



        $todos_status = Status::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)
            ->get();


        $clientes_2 = Clientes::with('Empreendimentos', 'Fontes')->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)
            ->orderBy('status_id_status', 'asc')
            ->orderBy('order_kanban', 'asc');



        if ($bd_users->perfil_usuario != 1) {
            $clientes_2 = $clientes_2->where('usuarios_id_usuario', auth()->user()->id);
        }

        $clientes_2 = $clientes_2->get();

        $tags =  Tags::select('titulo', DB::raw('COUNT(*) as quantidade'))
            ->join('cliente_tags', 'tags.id', '=', 'cliente_tags.tag_id')
            ->where('cliente_primario_id', $bd_users->clientes_primarios_id_cliente_primario)
            ->groupBy('titulo')
            ->get();



        /// FIM PERMISSÕES
        $sedes = Sedes::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();

        $db_empreendimentos = Empreendimentos::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();


        return view('clientes.vw-clientes', [
            'lista_empreendimentos' => $lista_empreendimentos,
            'lista_fontes' => $lista_fontes,
            'lista_corretores' => $lista_corretores,
            'lista_status' => $status,
            'permissoes' => $lista_permissao,
            'clientesSemStatus' => $clientesSemStatus,
            'status' => $status,
            'todos_status' => $todos_status,
            'tags' => $tags,
            'clientes' => $clientes_2,
            'clientes_total' => $clientes_total,
            "empreendimentos" => $db_empreendimentos,
            'status_cliente' => $status_cliente,
            'sedes' => $sedes,
            'filtro_clientes' => $filtro_clientes
        ]);
    }

    public function busca_clientes()
    {

        return view('clientes.vw-cliente-busca', [
            'data_inicio' => request()->data_inicio,
            'data_fim' => request()->data_fim,
            'opcao_pasta' => request()->opcao_pasta
        ]);
    }

    public function salvar_filtro()
    {


        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $filtro_dt = Filtro_dt_clientes::where('id_usuario', $bd_users->id)->where('id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->first();

        if (empty($filtro_dt)) {
            $filtro_dt = new Filtro_dt_clientes();
        }

        if (!empty(request()->data_criacao)) {
            $filtro_dt->data_criacao = trim(request()->data_criacao);
        }

        if (!empty(request()->data_fim)) {
            $filtro_dt->data_fim = trim(request()->data_fim);
        }

        if (isset(request()->id_fonte) || is_null(request()->id_fonte)) {
            $filtro_dt->id_fonte = request()->id_fonte;
        }

        if (isset(request()->ids_empreendimentos) || is_null(request()->ids_empreendimentos)) {

            if (is_null(request()->ids_empreendimentos)) {
                $ids_empreendimentos = null;
            } else {
                $ids_empreendimentos =  implode(',', request()->ids_empreendimentos);
            }

            $filtro_dt->ids_empreendimentos = $ids_empreendimentos;
        }

        if (isset(request()->id_corretor) || is_null(request()->id_corretor)) {
            $filtro_dt->id_corretor = request()->id_corretor;
        }


        if (isset(request()->ids_sedes) || is_null(request()->ids_sedes)) {

            if (is_null(request()->ids_sedes)) {
                $ids_sedes = null;
            } else {
                $ids_sedes =  implode(',', request()->ids_sedes);
            }

            $filtro_dt->ids_sedes = $ids_sedes;
        }

        if (isset(request()->nome_cliente) || is_null(request()->nome_cliente)) {
            $filtro_dt->nome_cliente = trim(request()->nome_cliente);
        }

        if (isset(request()->telefone) || is_null(request()->telefone)) {
            $filtro_dt->telefone = trim(request()->telefone);
        }

        if (isset(request()->email) || is_null(request()->telefone)) {
            $filtro_dt->email = trim(request()->email);
        }

        $filtro_dt->id_usuario = $bd_users->id;
        $filtro_dt->id_cliente_primario = $bd_users->clientes_primarios_id_cliente_primario;
        $filtro_dt->save();


        return response()->json([
            'status' => true,
            'message' => 'Exclusão efetuada com sucesso!',
        ]);
    }


    public function datatable_clientes()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();


        $db_clientes = Clientes::with('Empreendimentos', 'alertas', 'Usuarios', 'Status', 'Fontes', 'Cli_gp_sedes_emp.Empreendimentos', 'Cli_gp_sedes_emp.Sedes', 'Tags_clientes.tags')
            ->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);

        if ($bd_users->perfil_usuario != 1) {
            $db_clientes = $db_clientes->where('usuarios_id_usuario', auth()->user()->id);
        }

        $db_filtro = Filtro_dt_clientes::where('id_usuario', $bd_users->id)->where('id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->first();


        if (!empty($db_filtro->data_criacao)) {
            $db_clientes = $db_clientes->where('data_criacao', '>=', $db_filtro->data_criacao);
        }

        if (!empty($db_filtro->data_fim)) {
            $db_clientes = $db_clientes->where('data_atualizacao', '<=', $db_filtro->data_fim);
        }

        if (!empty($db_filtro->id_fonte)) {
            $db_clientes = $db_clientes->where('fontes_id_fonte', $db_filtro->id_fonte);
        }

        if (!empty($db_filtro->ids_empreendimentos)) {
            $ids_empreendimentos = explode(',', $db_filtro->ids_empreendimentos);

            $db_clientes = $db_clientes->whereHas('Cli_gp_sedes_emp.Empreendimentos', function ($query) use ($ids_empreendimentos) {
                $query->whereIn('id_empreendimento', $ids_empreendimentos);
            });
        }

        if (!empty($db_filtro->id_corretor)) {
            $db_clientes = $db_clientes->where('usuarios_id_usuario', $db_filtro->id_corretor);
        }

        if (!empty($db_filtro->ids_sedes)) {

            $ids_sedes = explode(',', $db_filtro->ids_sedes);

            $db_clientes = $db_clientes->whereHas('Cli_gp_sedes_emp.Sedes', function ($query) use ($ids_sedes) {
                $query->whereIn('id_sede', $ids_sedes);
            });
        }

        if (!empty($db_filtro->nome_cliente)) {
            $db_clientes = $db_clientes->where('nome_cliente','LIKE',"%{$db_filtro->nome_cliente}%");
        }

        if (!empty($db_filtro->telefone)) {
            $db_clientes = $db_clientes->where('telefone1_cliente','LIKE',"%{$db_filtro->telefone}%");
        }

        if (!empty($db_filtro->email)) {
            $db_clientes = $db_clientes->where('email1_cliente','LIKE',"%{$db_filtro->email}%");
        }

        foreach (request()->columns as $columns) {

            if (!empty($columns['search']['value'])) {

                // dd($columns['data'], request()->columns);
                // switch ($columns['data']) {
                //         // case "data_criacao":
                //         //     // dd($columns['search']['value'] , $columns['search']['value'] .' 00:00:00');
                //         //     // $db_clientes = $db_clientes->where('data_criacao', '>=', "2024-08-13");
                //         //     break;

                //         // case 'data_atualizacao':
                //         //     $db_clientes = $db_clientes->where('data_atualizacao', '<=', $columns['search']['value']);
                //         //     break;
                //     case 'email1_cliente':
                //         $db_clientes = $db_clientes->where('email1_cliente', $columns['search']['value']);
                //         break;
                //         // case 'status':
                //         //     $db_clientes = $db_clientes->where('XXXXXXXXXXXXX', $columns['search']['value']);
                //         //     break;
                //         // case 'nome_cliente':
                //         //     $db_clientes = $db_clientes->where('nome_cliente', $columns['search']['value']);
                //         //     break;
                //         // case 'corretor':
                //         //     $db_clientes = $db_clientes->where('usuarios_id_usuario', $columns['search']['value']);
                //         //     break;
                //         // case 'grupo_sede':
                //         //     $db_clientes = $db_clientes->where('XXXXXXXXXXXXX', $columns['search']['value']);
                //         //     break;
                //         // case 'grupo_empreendimento':
                //         //     $db_clientes = $db_clientes->where('XXXXXXXXXXXXX', $columns['search']['value']);
                //         //     break;
                //         // case 'fontes_id_fonte':
                //         //     $db_clientes = $db_clientes->where('XXXXXXXXXXXXX', $columns['search']['value']);
                //         //     break;
                //         // case 'telefone1_cliente':
                //         //     $db_clientes = $db_clientes->where('telefone1_cliente', $columns['search']['value']);
                //         //     break;
                //         // case 'tags':
                //         //     $db_clientes = $db_clientes->where('XXXXXXXXXXXXX', $columns['search']['value']);
                //         //     break;
                // }


                if ($columns['data'] == 'email1_cliente') {
                    $db_clientes = $db_clientes->where('email1_cliente', $columns['search']['value']);
                }

                if ($columns['data'] == 'data_criacao') {


                    $db_clientes = $db_clientes->whereDate('data_criacao', '>=', $columns['search']['value']);
                }
            }
        }

        // dd(request()->search['value']);

        // if(!empty(request()->search['value'])){

        //     $db_clientes = $db_clientes->whereDate('data_criacao', '>=', request()->search['value'] . " 00:00:00");

        // }

        // $db_clientes = $db_clientes->whereDate('data_criacao', '>=', request()->columns['search']);

        $db_clientes = $db_clientes->orderBy('id_cliente', 'desc')->limit(20)->get();

        // dd($db_clientes);



        return Datatables::of($db_clientes)
            ->editColumn('data_atualizacao', function ($data) {

                if (empty($data->status)) {
                    return '<span style="color:red;">' . date('d/m/Y H:i:s', strtotime($data->data_atualizacao)) . '</span>';
                } else {
                    return date('d/m/Y H:i:s', strtotime($data->data_atualizacao));
                }
            })
            ->editColumn('grupo_empreendimento', function ($data) {

                $badge = '';

                if (!empty($data->Cli_gp_sedes_emp)) {

                    foreach ($data->Cli_gp_sedes_emp as $gp) {

                        if (!empty($gp->empreendimentos->nome_empreendimento)) {
                            $badge .= '<span style="display: inline-block; padding: 5px 10px; background-color:#261758; color: #fff; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase;">' . $gp->empreendimentos->nome_empreendimento . '</span> ';
                        }
                    }

                    return $badge;
                }
            })
            ->editColumn('grupo_sede', function ($data) {

                $badge = '';


                if (!empty($data->Cli_gp_sedes_emp)) {

                    foreach ($data->Cli_gp_sedes_emp as $gp) {

                        if (!empty($gp->sedes->id_sede)) {
                            $badge .= '<span style="display: inline-block; padding: 5px 10px; background-color:#261758; color: #fff; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase;">' . $gp->sedes->nome_sede . '</span> ';
                        }
                    }

                    return $badge;
                }
            })
            ->editColumn('data_criacao', function ($data) {

                if (!empty($data->data_criacao)) {
                    if (empty($data->status)) {
                        return '<span style="color:red;">' . date('d/m/Y H:i:s', strtotime($data->data_criacao)) . '</span>';
                    } else {
                        return date('d/m/Y H:i:s', strtotime($data->data_criacao));
                    }
                }
            })
            ->editColumn('nome_cliente', function ($data) {

                if (empty($data->status)) {
                    return '<span style="color:red;">' . $data->nome_cliente . '</span>';
                } else {
                    return $data->nome_cliente;
                }
            })

            ->editColumn('telefone1_cliente', function ($data) {
                // Remove todos os caracteres não numéricos
                $telefone_sem_formatacao = preg_replace('/\D/', '', $data->telefone1_cliente);

                $telefone = $telefone_sem_formatacao;

                // Remove o prefixo "55" se estiver no início
                if (substr($telefone, 0, 2) === '55') {
                    $telefone = substr($telefone, 2);
                }

                // Formatação do telefone
                if (strlen($telefone) === 11) {
                    $telefone_formatado = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7);
                } elseif (strlen($telefone) === 10) {
                    $telefone_formatado = '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6);
                } else {
                    // Se não for 10 nem 11, retorna o número sem formatação
                    $telefone_formatado = $telefone_sem_formatacao;
                }

                // Verifica o status e retorna o link adequado
                if (empty($data->status)) {
                    return '<span style="color:red;"><a href="https://wa.me/55' . $telefone_sem_formatacao . '" target="_blank">' . $telefone_formatado . '</a></span>';
                } else {
                    return '<a href="https://wa.me/55' . $telefone_sem_formatacao . '" target="_blank">' . $telefone_formatado . '</a>';
                }
            })
            ->editColumn('email1_cliente', function ($data) {

                if (empty($data->status)) {
                    return '<span style="color:red;">' . $data->email1_cliente . '</span>';
                } else {
                    return $data->email1_cliente;
                }
            })
            ->editColumn('fontes_id_fonte', function ($data) {


                if (!empty($data->fontes)) {
                    $status_evolucao = Status_evolucao::with('status')->latest('data_status')->where('id_cliente', $data->id_cliente)->first();

                    if (empty($status_evolucao->status)) {
                        return '<span style="color:red;">' . $data->fontes->titulo_fonte . '</span>';
                    } else {
                        return $data->fontes->titulo_fonte;
                    }
                }
            })
            ->editColumn('status', function ($data) {

                if (!empty($data->status)) {
                    return $data->status->titulo_status;
                } else {
                    return '<span style="display: inline-block; padding: 5px 10px; background-color: red; color: #fff; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase;">SEM STATUS</span>';
                }
            })
            ->addColumn('corretor', function ($data) {


                if (!empty($data->usuarios)) {

                    $status_evolucao = Status_evolucao::with('status')->latest('data_status')->where('id_cliente', $data->id_cliente)->first();

                    if (empty($status_evolucao->status)) {
                        return '<span style="color:red;">' . $data->usuarios->name . '</span>';
                    } else {

                        return $data->usuarios->name;
                    }
                } else {
                    return '';
                }
            })
            ->addColumn('tags', function ($data) {



                if (!empty($data->tags_clientes->tags)) {

                    return '<span style="display: inline-block; padding: 5px 10px; background-color: ' . $data->tags_clientes->tags->cor . '; color: #fff; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase;">' . $data->tags_clientes->tags->titulo . '</span>';
                }
            })

            ->addColumn('action', function ($data) {


                $btn_editar = '<a href="javascript:void(0)" class="bttn-material-flat bttn-xs bttn-success btn_edit_ma" data-target="/admin/clientes/editar/' . $data->id_cliente . '"><i class="fa fa-edit"></i> Editar</a>';

                $btn_excluir = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-cli" data-target="' . $data->id_cliente . '"><i class="ri-delete-bin-5-line"></i> Excluir</button>';


                return   $btn_editar . '  ' . $btn_excluir;
            })
            ->rawColumns(['data_criacao', 'corretor', 'data_atualizacao', 'action', 'img_principal', 'numeros_imgs', 'arquivos', 'tags', 'empreendimento', 'fontes_id_fonte', 'status', 'nome_cliente', 'empreendimento', 'telefone1_cliente', 'email1_cliente', 'grupo_empreendimento', 'grupo_sede'])
            ->toJson();
    }

    public function search_datatable_realtime()
    {

        $searchTerm = request()->input('valor');


        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $db_clientes = Clientes::where('id_cliente', request()->id)
            ->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)
            ->where(function ($query) use ($searchTerm) {
                $query->where('data_criacao', 'like', "%{$searchTerm}%")
                    ->orWhere('data_atualizacao', 'like', "%{$searchTerm}%")
                    ->orWhere('email1_cliente', 'like', "%{$searchTerm}%");
                //   ->orWhere('colunaN', 'like', "%{$searchTerm}%");
            })
            ->where('id_cliente', request()->id)
            ->get();
    }

    public function datatable_clientes_status()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();


        $db_clientes = DB::table('clientes')->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)
            ->orderBy('id', 'asc');


        return Datatables::of($db_clientes)
            ->filterColumn('data_criacao', function ($query, $keyword) {
                $query->where('data_criacao', '>=', $keyword);
            })
            ->filterColumn('data_atualizacao', function ($query, $keyword) {
                $query->where('data_atualizacao', '<=', $keyword);
            })
            ->filterColumn('corretor', function ($query, $keyword) {
                $query->where('usuarios_id_usuario', $keyword);
            })
            ->filterColumn('empreendimento', function ($query, $keyword) {


                $query->where('id_empreendimento', $keyword);
            })
            ->filterColumn('fonte', function ($query, $keyword) {
                $query->where('fontes_id_fonte', $keyword);
            })
            ->filterColumn('status', function ($query, $keyword) {
                $query->where('status_id_status', $keyword);
            })
            ->editColumn('data_atualizacao', function ($data) {
                return date('d/m/Y H:i:s', strtotime($data->data_atualizacao));
            })
            ->editColumn('data_criacao', function ($data) {
                return date('d/m/Y H:i:s', strtotime($data->data_criacao));
            })
            ->editColumn('status', function ($data) {

                return date('d/m/Y H:i:s', strtotime($data->data_criacao));
            })
            ->editColumn('fontes_id_fonte', function ($data) {


                $fontes = Fontes::where('id_fonte', $data->fontes_id_fonte)->first();




                return $fontes->titulo_fonte;
            })
            ->editColumn('status', function ($data) {

                $status_evolucao = Status_evolucao::with('status')->latest('data_status')->where('id_cliente', $data->id)->first();

                if (!empty($status_evolucao)) {
                    return $status_evolucao->status->titulo;
                } else {
                    return '';
                }
            })
            ->addColumn('corretor', function ($data) {

                $usuario = Users::where('id', $data->usuarios_id_usuario)->first();

                if (!empty($usuario)) {

                    return $usuario->name;
                } else {
                    return '';
                }
            })
            ->addColumn('tags', function ($data) {

                $tags_cli = Tags_clientes::with('tags')->where('id_cliente', $data->id)->first();

                if (!empty($tags_cli)) {

                    return '<span style="display: inline-block; padding: 5px 10px; background-color: ' . $tags_cli->tags->cor . '; color: #fff; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase;">' . $tags_cli->tags->titulo . '</span>';
                }
            })
            ->addColumn('empreendimento', function ($data) {


                $empreendimento = Empreendimentos::where('id_empreendimento', $data->id_empreendimento)->first();

                if (!empty($empreendimento)) {

                    return "<a href='/admin/empreendimentos/editar/" . $empreendimento->id_empreendimento . "'>" . $empreendimento->nome_empreendimento . "</a>";
                } else {
                    return '';
                }
            })
            ->addColumn('numeros_imgs', function ($data) {

                $numero_imgs = Img_clientes::where('id_cliente', $data->id)
                    ->where('img_principal', 0)
                    ->whereNull('id_pasta')->count();

                if (!empty($numero_imgs)) {
                    $badge = '<a href="/admin/clientes/galeria/' . $data->id . '"><div class="icon-badge-group"><div class="icon-badge-container"><i class="ri-image-fill icon-badge-icon"></i><div class="icon-badge">' . $numero_imgs . '</div></div></div></a>';
                } else {
                    $badge = '<div class="icon-badge-group"><div class="icon-badge-container"><i class="ri-image-fill icon-badge-icon"></i><div class="icon-badge">' . $numero_imgs . '</div></div></div>';
                }

                return $badge;
            })
            ->addColumn('arquivos', function ($data) {

                $numero_imgs = Img_clientes::where('id_cliente', $data->id)
                    ->whereNotNull('id_pasta')->count();

                $badge = '<a href="/admin/clientes/pastas/' . $data->id . '"><div class="icon-badge-group"><div class="icon-badge-container"><i class="ri-folder-3-line icon-badge-icon"></i><div class="icon-badge">' . $numero_imgs . '</div></div></div></a>';

                return $badge;
            })

            ->addColumn('action', function ($data) {

                $bd_users =  Users::where('id', auth()->user()->id)->first();
                $permissoes_edit = Permissoes::where('id_usuario', $bd_users->id)->where('nome', 'funcao_edit_cliente')
                    ->first();



                // if ($bd_users->permissao == 'Administrador') {
                $btn_editar = '<a href="/admin/clientes/editar/' . $data->id . '" class="bttn-material-flat bttn-xs bttn-success"><i class="fa fa-edit"></i> Editar</a>';
                // } else if (!empty($permissoes_edit)) {

                //     if ($permissoes_edit->ativo == 'true') {
                //         $btn_editar = '<a href="/admin/clientes/editar/' . $data->id . '" class="bttn-material-flat bttn-xs bttn-success"><i class="fa fa-edit"></i> Editar</a>';
                //     } else {

                //         $btn_editar = '';
                //     }
                // } else {
                //     $btn_editar = '';
                // }

                $permissoes_excluir = Permissoes::where('id_usuario', $bd_users->id)->where('nome', 'funcao_excluir_cliente')
                    ->first();


                // if ($bd_users->permissao == 'Administrador') {
                $btn_excluir = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-cli" data-target="' . $data->id . '"><i class="ri-delete-bin-5-line"></i> Excluir</button>';
                // } else if (!empty($permissoes_excluir)) {

                //     if ($permissoes_excluir->ativo == 'true') {
                //         $btn_excluir = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-cli" data-target="' . $data->id . '"><i class="ri-delete-bin-5-line"></i> Excluir</button>';
                //     } else {
                //         $btn_excluir = '';
                //     }
                // } else {
                //     $btn_excluir = '';
                // }

                return   $btn_editar . '  ' . $btn_excluir;
            })
            ->rawColumns(['action', 'img_principal', 'numeros_imgs', 'arquivos', 'tags', 'empreendimento', 'fontes_id_fonte'])
            ->toJson();
    }

    public function datatable_clientes_busca()
    {


        $bd_users =  Users::where('id', auth()->user()->id)->first();


        $db_clientes = DB::table('clientes')->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);


        return Datatables::of($db_clientes)
            ->editColumn('data_atualizacao', function ($data) {
                return date('d/m/Y H:i:s', strtotime($data->data_atualizacao));
            })
            ->editColumn('data_criacao', function ($data) {
                return date('d/m/Y H:i:s', strtotime($data->data_criacao));
            })
            ->editColumn('fontes', function ($data) {
                $fontes = Fontes::where('id_cliente_primario', $data->id)->first();

                if (!empty($fontes)) {
                    return $fontes->titulo;
                } else {
                    return '';
                }
            })
            ->editColumn('status', function ($data) {

                $status_evolucao = Status_evolucao::with('status')->latest('data_status')->where('id_cliente', $data->id)->first();

                if (!empty($status_evolucao)) {
                    return $status_evolucao->status->titulo;
                } else {
                    return '';
                }
            })
            ->addColumn('corretor', function ($data) {

                $usuario = Users::where('id', $data->usuarios_id_usuario)->first();

                if (!empty($usuario)) {

                    return $usuario->name;
                } else {
                    return '';
                }
            })
            ->addColumn('tags', function ($data) {

                $tags_cli = Tags_clientes::with('tags')->where('id_cliente', $data->id)->first();

                if (!empty($tags_cli)) {

                    return '<span style="display: inline-block; padding: 5px 10px; background-color: ' . $tags_cli->tags->cor . '; color: #fff; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase;">' . $tags_cli->tags->titulo . '</span>';
                }
            })
            ->addColumn('empreendimento', function ($data) {


                $empreendimento = Empreendimentos::where('id_empreendimento', $data->id_empreendimento)->first();

                if (!empty($empreendimento)) {

                    return "<a href='/admin/empreendimentos/editar/" . $empreendimento->id_empreendimento . "'>" . $empreendimento->nome_empreendimento . "</a>";
                } else {
                    return '';
                }
            })
            ->addColumn('numeros_imgs', function ($data) {

                $numero_imgs = Img_clientes::where('id_cliente', $data->id)
                    ->where('img_principal', 0)
                    ->whereNull('id_pasta')->count();

                if (!empty($numero_imgs)) {
                    $badge = '<a href="/admin/clientes/galeria/' . $data->id . '"><div class="icon-badge-group"><div class="icon-badge-container"><i class="ri-image-fill icon-badge-icon"></i><div class="icon-badge">' . $numero_imgs . '</div></div></div></a>';
                } else {
                    $badge = '<div class="icon-badge-group"><div class="icon-badge-container"><i class="ri-image-fill icon-badge-icon"></i><div class="icon-badge">' . $numero_imgs . '</div></div></div>';
                }

                return $badge;
            })
            ->addColumn('arquivos', function ($data) {

                $numero_imgs = Img_clientes::where('id_cliente', $data->id)
                    ->whereNotNull('id_pasta')->count();

                $badge = '<a href="/admin/clientes/pastas/' . $data->id . '"><div class="icon-badge-group"><div class="icon-badge-container"><i class="ri-folder-3-line icon-badge-icon"></i><div class="icon-badge">' . $numero_imgs . '</div></div></div></a>';

                return $badge;
            })

            ->addColumn('action', function ($data) {
                $btn_editar = '<a href="/admin/clientes/editar/' . $data->id . '" class="bttn-material-flat bttn-xs bttn-success"><i class="fa fa-edit"></i> Editar</a>';
                $btn_excluir = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-cli" data-target="' . $data->id . '"><i class="ri-delete-bin-5-line"></i> Excluir</button>';
                return   $btn_editar . '  ' . $btn_excluir;
            })
            ->rawColumns(['action', 'img_principal', 'numeros_imgs', 'arquivos', 'tags', 'empreendimento'])
            ->toJson();
    }

    public function editar($id)
    {

        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;

        $bd_pc = ProvedorContato::where('clientes_primarios_id_cliente_primario', $cliente_primario)->orderBy('titulo_provedor_contato', 'asc')->get();

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $users = Users::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();


        $status_evolucao = Status_evolucao::with('clientes', 'status', 'tags_clientes.tags')
            ->where('id_cliente', $id)
            ->orderBy('id', 'desc')
            ->get();
        $tags_clientes = Tags_clientes::with('tags')->where('cliente_id', $id)->get();

        $status = Status::where('clientes_primarios_id_cliente_primario', $cliente_primario)->get();

        $fontes = Fontes::where('clientes_primarios_id_cliente_primario', $cliente_primario)->get();
        $tags = Tags::where('cliente_primario_id', $cliente_primario)->get();


        $db_clientes = Clientes::with('alertas', 'empreendimentos', 'fontes')->where('id_cliente', $id)
            ->where('clientes_primarios_id_cliente_primario', $cliente_primario);

        if ($bd_users->perfil_usuario != 1) {
            $db_clientes = $db_clientes->where('clientes_primarios_id_cliente_primario', $cliente_primario);
        }

        $db_clientes = $db_clientes->first();

        if (empty($db_clientes)) {
            return view('erros_page.404', []);
        }

        $db_alertas = Alertas::where('id_cliente', $db_clientes->id_cliente)->get();

        $db_contatos_realizados = Contatos_realizados::where('id_cliente', $db_clientes->id_cliente)->get();

        if (!empty($db_clientes)) {

            return view('clientes.vw-edit-cli', [
                'cliente' => $db_clientes,
                'status_evolucao' => $status_evolucao,
                'status' => $status,
                'tags' => $tags,
                'fontes' => $fontes,
                'tags_clientes' => $tags_clientes,
                'alertas' => $db_alertas,
                'contatos_realizados' => $db_contatos_realizados,
                'users' => $users,
                'provedor_contatos' => $bd_pc
            ]);
        }

        if (empty($db_clientes)) {
            return view('erros_page.404', []);
        }
    }

    public function add_img($id)
    {
        return view('clientes.vw-add-img', [
            'id_cliente' => $id
        ]);
    }

    public function upload_img($id)
    {

        if (request()->hasFile('files')) {

            $file = request()->file('files');

            $caminho_imagem = 'upload/clientes/' . $id . '/';
            $nome_do_arquivo = $file->getClientOriginalName();


            if (file_exists(public_path($caminho_imagem . $nome_do_arquivo))) {

                $extensao_do_arquivo = pathinfo($nome_do_arquivo, PATHINFO_EXTENSION);

                // Procura por um nome de arquivo único
                while (file_exists(public_path($caminho_imagem . $nome_do_arquivo))) {
                    $nome_arquivo_original = $nome_do_arquivo;
                    $nome_do_arquivo = Str::random(30) . '.' . $extensao_do_arquivo;
                }
            } else {
                $nome_arquivo_original = $nome_do_arquivo;
            }


            $file->move(public_path($caminho_imagem), $nome_do_arquivo);

            // Constrói a URL do arquivo a partir do caminho relativo
            $url_imagem = url($caminho_imagem . $nome_do_arquivo);

            $bd_img = new Img_clientes();
            $bd_img->url_img = $caminho_imagem . $nome_do_arquivo;
            $bd_img->nome = $nome_do_arquivo;
            $bd_img->nome_original = $nome_arquivo_original;
            $bd_img->id_cliente = $id;
            $bd_img->img_principal = 0;
            $bd_img->save();
        }
    }

    public function upload_img_principal($id)
    {

        if (request()->hasFile('files')) {

            $db_img_emp = Img_clientes::where('id_cliente', $id)
                ->where('img_principal', 1);
            if (!empty($db_img_emp->first())) {
                $caminho_pasta = public_path('upload/clientes/' . $id . '/img_principal');
                $db_img_emp->delete();
                File::deleteDirectory($caminho_pasta);
            }

            $file = request()->file('files');

            $caminho_imagem = 'upload/clientes/' . $id . '/img_principal';
            $nome_do_arquivo = $file->getClientOriginalName();






            $extensao_do_arquivo = pathinfo($nome_do_arquivo, PATHINFO_EXTENSION);

            // Procura por um nome de arquivo único


            $nome_arquivo_original = $nome_do_arquivo;


            $nome_do_arquivo = Str::random(30) . '.' . $extensao_do_arquivo;




            $file->move(public_path($caminho_imagem), $nome_do_arquivo);

            // Constrói a URL do arquivo a partir do caminho relativo
            $url_imagem = url($caminho_imagem . $nome_do_arquivo);

            $bd_img = new Img_clientes();
            $bd_img->url_img = $caminho_imagem . '/' . $nome_do_arquivo;
            $bd_img->nome = $nome_do_arquivo;
            $bd_img->nome_original = $nome_arquivo_original;
            $bd_img->id_cliente = $id;
            $bd_img->img_principal = 1;
            $bd_img->save();
        }
    }


    public function excluir()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $db_clientes = Clientes::where('id_cliente', request()->id)
            ->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);


        if (!empty($db_clientes->first())) {

            $db_img_clientes = Img_clientes::where('id_cliente', request()->id);

            if (!empty($db_img_clientes->get())) {

                foreach ($db_img_clientes->get() as $db_img_cliente) {

                    $file_img_cliente = public_path($db_img_cliente->url_img);
                    unlink($file_img_cliente);

                    Img_clientes::where('id', $db_img_cliente->id)->delete();
                }
            }

            $db_clientes->delete();

            return response()->json([
                'status' => true,
                'message' => 'Exclusão efetuada com sucesso!',
            ]);
        }
    }

    public function galeria($id)
    {

        $db_img_cli = Img_clientes::where('id_cliente', $id)
            ->where('img_principal', 0);

        return view('clientes.vw-cli-galeria', [
            'id_empreendimento' => $id,
            'paginacao' => $db_img_cli->paginate(10),
            'imagens' => $db_img_cli->get()
        ]);
    }

    public function gerenciar_pasta($id_cliente)
    {

        $opcoes_pastas = Pastas::get();

        return view('clientes.vw-gerenciar_pasta', [
            'opcoes_pastas' => $opcoes_pastas,
            'id_cliente' => $id_cliente
        ]);
    }

    public function pastas($id)
    {

        $grupos_pastas = Cat_pasta_clientes::where('id_cliente', $id)->with('pasta');


        return view('clientes.vw-pastas', [
            'grupos_pastas' => $grupos_pastas->get(),
            'paginacao' => $grupos_pastas->paginate(10),
            'id_cliente' => $id
        ]);
    }

    public function add_pasta()
    {

        $bd_categoria_pasta = new Cat_pasta_clientes();

        $bd_categoria_pasta->descricao = request()->descricao;
        $bd_categoria_pasta->nome = request()->nome;
        $bd_categoria_pasta->id_cliente = request()->id_cliente;
        $bd_categoria_pasta->id_pasta = request()->opcao_pasta;


        if ($bd_categoria_pasta->save()) {

            return response()->json([
                'status' => true,
                'message' => 'Pasta criada com sucesso!',
            ]);
        } else {

            return response()->json([
                'status' => false,
                'message' => 'Erro para salvar!',
            ]);
        }
    }

    public function datatable_cli_ger_pastas(Request $request)
    {

        $id = $request->input('id');

        $db_img_cli = DB::table('cat_pasta_clientes')->where('id_cliente', $id);


        return Datatables::of($db_img_cli)
            ->addColumn('url', function ($data) {
                $pasta = Pastas::where('id', $data->id_pasta)->first();
                $img = '<div style="display:flex;justify-content:center;"><img src="' . asset($pasta->url) . '" style="width:40px;"></div>';
                return  $img;
            })
            ->addColumn('arquivos', function ($data) {

                $numero_imgs = Img_clientes::where('id_pasta', $data->id)->count();


                $badge = '<div style="display:flex;justify-content:center;"><a href="/admin/clientes/arquivos/' . $data->id . '"><div class="icon-badge-group"><div class="icon-badge-container"><i class="ri-folder-3-line icon-badge-icon"></i><div class="icon-badge">' . $numero_imgs . '</div></div></div></a></div>';


                return $badge;
            })
            ->addColumn('action', function ($data) {

                $btn_editar = '<button class="bttn-material-flat bttn-xs bttn-success btn-emp-editar-pasta" data-target="' . $data->id . '"><i class="fa fa-edit" ></i> Editar</button>';
                $btn_excluir = '<button class="bttn-material-flat bttn-xs bttn-danger btn-emp-excluir-pasta" data-target="' . $data->id . '"><i class="ri-delete-bin-5-line"></i> Excluir</button>';
                return $btn_editar . " " . $btn_excluir;
            })
            ->rawColumns(['action', 'url', 'arquivos'])
            ->toJson();
    }

    public function edit_pasta()
    {

        $bd_categoria_pasta = Cat_pasta_clientes::where('id', request()->id)->first();


        $bd_categoria_pasta->descricao = request()->descricao;
        $bd_categoria_pasta->nome = request()->nome;
        $bd_categoria_pasta->id_cliente = request()->id_cliente;
        $bd_categoria_pasta->id_pasta = request()->opcao_pasta;

        if ($bd_categoria_pasta->save()) {

            return response()->json([
                'status' => true,
                'message' => 'Pasta atualizado com sucesso!',
            ]);
        } else {

            return response()->json([
                'status' => false,
                'message' => 'Erro para salvar!',
            ]);
        }
    }

    public function excluir_pasta()
    {

        $bd_categoria_pasta = Cat_pasta_clientes::where('id', request()->id)->first();

        if (!empty($bd_categoria_pasta->first())) {

            $bd_categoria_pasta->delete();

            return response()->json([
                'status' => true,
                'message' => 'Exclusão efetuada com sucesso!',
            ]);
        }
    }

    public function arquivos($id)
    {
        $bd_categoria_pasta = Cat_pasta_clientes::where('id', $id)->first();

        return view('clientes.vw-cli-arquivos', [
            'id_pasta' => $id,
            'id_cliente' => $bd_categoria_pasta->id_cliente
        ]);
    }

    public function pdf_cliente($cliente_id)
    {

        $cliente = Clientes::where('id_cliente', $cliente_id)->first();

        $data = [
            'cliente' => $cliente
        ];

        $pdf = PDF::loadView('pdf.cliente_pdf', $data);
        return $pdf->download('cliente_Sistema.pdf');
    }

    public function atualizar()
    {

        $db_clientes = Clientes::where('id_cliente', request()->id)->first();

        $db_clientes->nome_cliente = request()->nome;
        // $db_clientes->empreendimento = request()->emp;
        $db_clientes->telefone1_cliente = request()->telefone;
        $db_clientes->celular = request()->celular;
        $db_clientes->email1_cliente = request()->email_1;
        $db_clientes->email2_cliente = request()->email_2;
        $db_clientes->cep_cliente = request()->cep;
        $db_clientes->fgts = request()->fgts;
        $db_clientes->endereco_cliente = request()->endereco;
        $db_clientes->numero_end_cliente = request()->numero;
        $db_clientes->bairro_cliente = request()->bairro;
        $db_clientes->cidade_cliente = request()->cidade;
        $db_clientes->estado_cliente = request()->estado;


        if ($db_clientes->save()) {

            return response()->json([
                "status" => true,
                "message" => 'Editado com sucesso!'
            ]);
        } else {

            return response()->json([
                "status" => false,
                "message" => 'Erro ao salvar!'
            ]);
        }
    }

    public function add_status()
    {

        $status_evolucao = new Status_evolucao();

        $status_evolucao->data_status = date('Y-m-d H:i:s');
        $status_evolucao->id_status = request()->id_status;
        $status_evolucao->id_cliente = request()->id_cliente;

        Clientes::where('id_cliente', request()->id_cliente)->update(
            [
                'status_id_status' => request()->id_status
            ]
        );

        if ($status_evolucao->save()) {
            return response()->json(
                [
                    'status' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => false

                ]
            );
        }
    }

    public function alt_status()
    {

        $cliente = Clientes::where('id_cliente', request()->id_cliente)->first();

        $cliente_ultima_order_kanban = Clientes::where('status_id_status', request()->id_status)
            ->where('order_kanban', '!=', 0)
            ->whereNotNull('order_kanban')
            ->orderby('order_kanban', 'desc')
            ->first()->order_kanban;

        if (!empty($cliente)) {

            $cliente->status_id_status = request()->id_status;
            $cliente->order_kanban = $cliente_ultima_order_kanban + 1;
            $cliente->save();
        }

        return response()->json(
            [
                'status' => true
            ]
        );
    }

    public function add_tag()
    {

        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;

        $tags_clientes = new Tags_clientes();

        $tags_clientes->tag_id = request()->id_tag;
        $tags_clientes->cliente_id = request()->id_cliente;

        if ($tags_clientes->save()) {
            return response()->json(
                [
                    'status' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => false

                ]
            );
        }
    }

    public function add_fonte()
    {

        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;

        $db_cliente = Clientes::where('id_cliente', request()->id_cliente)
            ->where('clientes_primarios_id_cliente_primario', $cliente_primario)
            ->first();



        $db_cliente->fontes_id_fonte = request()->id_fonte;

        if ($db_cliente->save()) {
            return response()->json(
                [
                    'status' => true
                ]
            );
        } else {
            return response()->json(
                [
                    'status' => false

                ]
            );
        }
    }

    public function excluir_tag()
    {

        $tags_clientes = Tags_clientes::where('id', request()->id_tag_cliente)->first();

        if (!empty($tags_clientes)) {

            $tags_clientes->delete();

            return response()->json([
                'status' => true,
                'message' => 'Exclusão efetuada com sucesso!',
            ]);
        }
    }

    public function add_contato()
    {

        $users = Users::where('id', auth()->user()->id)->first();
        $cliente_primario = $users->clientes_primarios_id_cliente_primario;
        $id_usuario =  $users->id;


        $bd_pc = ProvedorContato::where('id_provedor_contato', request()->provedor_contato)
            ->where('clientes_primarios_id_cliente_primario', $cliente_primario)
            ->first();


        $contatos_realizados = new Contatos_realizados;
        $contatos_realizados->data = date('d/m/Y', strtotime(request()->data_cliente));
        $contatos_realizados->horario = request()->horario_cliente;
        $contatos_realizados->comunicacao = $bd_pc->titulo_provedor_contato;
        $contatos_realizados->obs_contato = request()->observacao_cliente;
        $contatos_realizados->id_cliente = request()->id_cliente;
        $contatos_realizados->id_usuario = $id_usuario;
        $contatos_realizados->id_cliente_primario = $cliente_primario;

        if ($contatos_realizados->save()) {

            return response()->json([
                'status' => true
            ]);
        }
    }

    public function add_alerta()
    {

        $bd_alerta = new Alertas();
        $bd_alerta->id_cliente = request()->id_cliente;
        $bd_alerta->mensagem = request()->mensagem_alerta;
        $bd_alerta->cor = request()->cor_alerta;
        $bd_alerta->data =  date('d/m/Y', strtotime(request()->data_alerta));
        $bd_alerta->horario = request()->horario_alerta;
        $bd_alerta->visualizado = 0;


        if ($bd_alerta->save()) {

            return response()->json([
                'status' => true
            ]);
        }
    }

    public function excluir_alerta()
    {

        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;

        $bd_alerta = Alertas::where('id', request()->id_alerta)->first();

        $bd_clientes = Clientes::where('id_cliente', $bd_alerta->id_cliente)
            ->where('clientes_primarios_id_cliente_primario', $cliente_primario)->first();

        if (!empty($bd_clientes)) {

            if (!empty($bd_alerta)) {

                $bd_alerta->delete();

                return response()->json([
                    'status' => true,
                    'message' => 'Exclusão efetuada com sucesso!',
                ]);
            }
        }
    }

    public function excluir_contato()
    {

        $contatos_realizados = Contatos_realizados::where('id', request()->id_contato)->first();

        if (!empty($contatos_realizados)) {

            $contatos_realizados->delete();

            return response()->json([
                'status' => true,
                'message' => 'Exclusão efetuada com sucesso!',
            ]);
        }
    }

    public function get_contato()
    {

        $cr = Contatos_realizados::where('id', request()->id_contato)->first();

        return response()->json([
            'dia' => date('Y/m/d', strtotime($cr->data)),
            'horario' => $cr->horario,
            'comunicacao' => $cr->comunicacao,
            'obs_contato' => $cr->obs_contato
        ]);
    }

    public function adicionar_cliente()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $sedes = Sedes::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();

        $db_empreendimentos = Empreendimentos::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();

        return view('clientes.vw-add-cliente', [
            "empreendimentos" => $db_empreendimentos,
            "sedes" => $sedes,
        ]);
    }

    public function inserir_cliente()
    {
        $clientes = Clientes::where('nome_cliente', request()->nome)->first();
        $bd_users =  Users::where('id', auth()->user()->id)->first();

        if (empty(request()->nome)) {

            return  response()->json([
                'status' => false,
                'message' => 'Necessário incluir um cliente'
            ]);
        }

        if (!isset(request()->id_sedes)) {
            return  response()->json([
                'status' => false,
                'message' => 'Necessário inserir uma sede'
            ]);
        }



        if (!empty($clientes)) {

            return  response()->json([
                'status' => false,
                'message' => 'Nome do cliente já cadastrado'
            ]);
        }

        $clientes = new Clientes;
        $clientes->nome_cliente = request()->nome;
        $clientes->celular = request()->celular;
        $clientes->telefone1_cliente = request()->telefone;
        $clientes->email1_cliente = request()->email1;
        $clientes->email2_cliente = request()->email2;
        $clientes->usuarios_id_usuario = auth()->user()->id;
        $clientes->data_registro = date('Y-m-d');
        $clientes->arquivado_cliente = 0;
        $clientes->clientes_primarios_id_cliente_primario = $bd_users->clientes_primarios_id_cliente_primario;
        $clientes->save();


        foreach (request()->id_sedes as $id_sede) {
            $cli_gp = new Cli_gp_sedes_emp();
            $cli_gp->id_cliente = $clientes->id_cliente;
            $cli_gp->id_cliente_primario = $bd_users->clientes_primarios_id_cliente_primario;
            $cli_gp->id_sede = $id_sede;
            $cli_gp->save();
        }


        foreach (request()->id_empreendimentos as $id_empreendimento) {
            $cli_gp = new Cli_gp_sedes_emp();
            $cli_gp->id_cliente = $clientes->id_cliente;
            $cli_gp->id_cliente_primario = $bd_users->clientes_primarios_id_cliente_primario;
            $cli_gp->id_empreendimento = $id_empreendimento;
            $cli_gp->save();
        }


        return response()->json([
            'status' => true,
            'message' => 'Cliente Cadastrado com sucesso'
        ]);
    }

    public function atualizar_status_kanban()
    {
        try {
            $idCliente = request()->input('id_cliente');
            $idStatus = request()->input('id_status');

            $cliente = Clientes::find($idCliente);

            if (!$cliente) {
                return response()->json(['message' => 'Cliente não encontrado'], 404);
            }

            $cliente->status_id_status = $idStatus;
            $cliente->save();

            $status_evolucao = new Status_evolucao();

            $status_evolucao->data_status = date('Y-m-d H:i:s');
            $status_evolucao->id_status = $idStatus;
            $status_evolucao->id_cliente = $idCliente;
            $status_evolucao->save();

            $ordem = 1;

            foreach (request()->clienteIds as $cliente_id) {

                $cliente = Clientes::where('id_cliente', $cliente_id)->first();

                $cliente->order_kanban = $ordem;
                $cliente->save();

                $ordem++;
            }

            $status = Status::where('id_status', $idStatus)->first();

            return response()->json(
                [
                    'cliente_id' => request()->input('id_cliente'),
                    'titulo_status' => $status->titulo_status,
                    'cor' => $status->cor
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar status: ' . $e->getMessage()], 500);
        }
    }

    public function option_select_empreendimento()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();
        // // Obtém os IDs das sedes da requisição
        $ids_sedes = request()->input('ids_sedes');

        // Verifica se os IDs das sedes estão definidos
        if (request()->opcoes_salva == false) {

            if (empty($ids_sedes)) {
                return response()->json([
                    'status' => false,
                    'message' => 'IDs de sede não fornecidos.'
                ]);
            }

            // Consulta as sedes com base nos IDs fornecidos
            $bd_gs = Grupo_sede::with('Empreendimentos')->whereIn('id_sede', $ids_sedes)->get();

            // dd($bd_gs);

            $empreendimentos = [];
            $nome_empreendimentos = [];

            foreach ($bd_gs as $gs) {
                // Verifica se o nome da sede já foi adicionado

                if (!in_array($gs->empreendimentos->nome_empreendimento, $nome_empreendimentos)) {
                    $empreendimentos[] = [
                        'id' => $gs->id_empreendimento,
                        'nome' => $gs->empreendimentos->nome_empreendimento,
                    ];
                    $nome_empreendimentos[] = $gs->empreendimentos->nome_empreendimento;
                }
            }
        }

        if (request()->opcoes_salva == true) {

            $filtro_dt_emp = Filtro_dt_clientes::where('id_usuario', $bd_users->id)->where('id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->first();

            if (!empty($filtro_dt_emp->ids_empreendimentos)) {
                $filtro_ids_empreendimentos = explode(',', $filtro_dt_emp->ids_empreendimentos);
            }
        } else {
            $filtro_ids_empreendimentos = '';
        }

        // Retorna a resposta JSON
        return response()->json([
            'status' => true,
            'empreendimentos' => $empreendimentos,
            'filtro_ids_empreendimentos' => $filtro_ids_empreendimentos
        ]);
    }

    public function option_select_sedes()
    {
        $bd_users = Users::where('id', auth()->user()->id)->first();

        $filtro_dt_sedes = Filtro_dt_clientes::where('id_usuario', $bd_users->id)
            ->where('id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)
            ->first();

        $filtro_ids_sedes = !empty($filtro_dt_sedes->ids_sedes) ? explode(',', $filtro_dt_sedes->ids_sedes) : [];

        $bd_sedes = Sedes::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();

        $sedes = [];
        $nome_sede = [];

        foreach ($bd_sedes as $sede) {
            // Verifica se o nome da sede já foi adicionado
            if (!in_array($sede->nome_sede, $nome_sede)) {
                $sedes[] = [
                    'id' => $sede->id_sede, // Presumindo que você quer o ID da sede
                    'nome' => $sede->nome_sede,
                ];
                $nome_sede[] = $sede->nome_sede;
            }
        }



        // EMPREENDIMENTOS
        $bd_gs = Grupo_sede::with('Empreendimentos')->whereIn('id_sede', $filtro_ids_sedes)->get();

        $empreendimentos = [];
        $nome_empreendimentos = [];

        foreach ($bd_gs as $gs) {
            // Verifica se o nome da sede já foi adicionado

            if (!in_array($gs->empreendimentos->nome_empreendimento, $nome_empreendimentos)) {
                $empreendimentos[] = [
                    'id' => $gs->id_empreendimento,
                    'nome' => $gs->empreendimentos->nome_empreendimento,
                ];
                $nome_empreendimentos[] = $gs->empreendimentos->nome_empreendimento;
            }
        }

        if (!empty($filtro_dt_sedes->ids_empreendimentos)) {

            $filtro_dt_emp = Filtro_dt_clientes::where('id_usuario', $bd_users->id)->where('id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->first();

            if (!empty($filtro_dt_emp->ids_empreendimentos)) {
                $filtro_ids_empreendimentos = explode(',', $filtro_dt_emp->ids_empreendimentos);
            }
        } else {
            $filtro_ids_empreendimentos = '';
        }
 


        return response()->json([
            'status' => true,
            'filtro_ids_sedes' => $filtro_ids_sedes,
            'filtro_options_sedes' => $sedes,
            'filtro_ids_empreendimentos' => $empreendimentos,
            'filtro_options_empreendimentos' => $filtro_ids_empreendimentos
        ]);
    }
}
