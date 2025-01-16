<?php

namespace App\Http\Controllers\roleta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empreendimentos;
use App\Models\Permissoes;
use App\Models\User;
use App\Functions\Validacao;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\Facades\DataTables;
use App\Models\Users;
use Illuminate\Support\Str;
use App\Models\Img_empreendimentos;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Cat_pasta_emp;
use App\Models\Pastas;
use App\Models\Fontes;
use App\Models\Roleta;
use App\Models\Roleta_Usuario;
use App\Models\Sedes;
use App\Models\tags;
use App\Models\Portais;
use Carbon\Carbon;



class RoletaController extends Controller
{

    function __construct() {}

    public function index()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $permissoes = Permissoes::where('id_usuario', $bd_users->id)->get();

        $lista_permissao = [];

        foreach ($permissoes as $permissao) {
            $lista_permissao[$permissao->nome] = $permissao->ativo;
        }

        if ($bd_users->permissao == 'Administrador') {
            $user_admin = 1;
        } else {
            $user_admin = 0;
        }

        $bd_fontes = Fontes::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();
        $bd_sedes = Sedes::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();
        $bd_empreendimento = Empreendimentos::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();

        /// FIM PERMISSÕES

        return view('roleta.vw-roleta', [
            'permissoes' => $lista_permissao,
            'user_admin' => $user_admin,
            'bd_fontes' => $bd_fontes,
            'bd_sedes' => $bd_sedes,
            'bd_empreendimento' => $bd_empreendimento
        ]);
    }

    public function get_usuario_roleta() {}

    public function datatable_roleta()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();


        $datatable_roleta = DB::table('roleta')->where('id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);



        return Datatables::of($datatable_roleta)

            ->addColumn('empreendimento', function ($data) {

                $empreendimentos = Empreendimentos::where('id_empreendimento', $data->id_empreendimento)->first();

                if (!empty($empreendimentos->nome_empreendimento)) {
                    return $empreendimentos->nome_empreendimento;
                }
            })
            ->addColumn('dt_criacao', function ($data) {

                return Carbon::parse($data->dt_criacao)->format('d-m-Y H:i:s');
            })
            ->addColumn('prazo', function ($data) {

                return Carbon::parse($data->prazo)->format('d-m-Y H:i:s');
            })
            ->addColumn('id_fonte', function ($data) {

                $fonte = Fontes::where('id_fonte', $data->id_fonte)->first();


                if (!empty($fonte->titulo_fonte)) {
                    return $fonte->titulo_fonte;
                } else {
                    return '';
                }
            })
            ->addColumn('sede', function ($data) {
                $sede = Sedes::where('id_sede', $data->id_sede)->first();

                if (!empty($sede)) {
                    return $sede->nome_sede;
                }
            })
            ->addColumn('empreendimento', function ($data) {
                $empreendimentos = Empreendimentos::where('id_empreendimento', $data->id_empreendimento)->first();
                if (!empty($empreendimentos)) {
                    return $empreendimentos->nome_empreendimento;
                }
            })
            ->addColumn('action', function ($data) {

                $bd_users =  Users::where('id', auth()->user()->id)->first();

                $permissoes_excluir = Permissoes::where('id_usuario', $bd_users->id)->where('nome', 'funcao_excluir_emp')
                    ->first();

                // if ($bd_users->permissao == 'Administrador') {

                    $btn_excluir = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-roleta" data-target="' . $data->id . '"><i class="ri-delete-bin-5-line"></i> Excluir</button>';
                    $btn_visualizar = '<button class="bttn-material-flat bttn-xs bttn-success btn-editar-roleta" data-target="' . $data->id . '"><i class="ri-delete-bin-5-line"></i> Editar</button>';
                // } else if (!empty($permissoes_excluir)) {

                //     if ($permissoes_excluir->ativo == 'true' || $bd_users->permissao == 'Administrador') {
                //         $btn_visualizar = '<button class="bttn-material-flat bttn-xs bttn-success btn-editar-roleta" data-target="' . $data->id . '"><i class="ri-delete-bin-5-line"></i> Editar</button>';
                //         $btn_excluir = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-roleta" data-target="' . $data->id . '"><i class="ri-delete-bin-5-line"></i> Excluir</button>';
                //     } else {
                //         $btn_excluir = '';
                //         $btn_visualizar  = '';
                //     }
                // } else {
                //     $btn_excluir = '';
                //     $btn_visualizar = '';
                // }

                return  $btn_visualizar . " " . $btn_excluir;
            })
            ->rawColumns(['action', 'img_principal', 'numeros_imgs', 'arquivos'])
            ->toJson();
    }

    public function datatable_add_roleta()
    {


        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $usuarios = DB::table('users')->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);
        dd($usuarios->get());


        return Datatables::of($usuarios)
            ->addColumn('parte_roleta', function ($data) {

                $db_roleta_usuario =  Roleta_usuario::where('id_usuario', $data->id)->first();

                if (!empty($db_roleta_usuario)) {
                    return '<select class="" name="faz_parte_roleta" id="faz_parte_roleta">
                <option value="sim">SIM</option>
                 <option value="nao">NÃO</option>
                 </select>';
                } else {
                    return  '<select class="" name="faz_parte_roleta" id="faz_parte_roleta">
                    <option value="nao">NÃO</option>
                     <option value="sim">SIM</option>
                     </select>';
                }
            })
            ->addColumn('tempo', function ($data) {

                $db_roleta_usuario =  Roleta_usuario::where('id_usuario', $data->id)
                    ->first();

                if (!empty($db_roleta_usuario)) {

                    if ($db_roleta_usuario->tempo == 0) {

                        $valor = 0;
                        $valor_2 = 'Selecione';
                    } else {

                        $valor = $db_roleta_usuario->tempo;
                        $valor_2 = $db_roleta_usuario->tempo . ' min';
                    }
                } else {
                    $valor = 0;
                    $valor_2 = 'Selecione';
                }

                return '<select class="" name="tempo" id="tempo">
                 <option value="' . $valor . '">' . $valor_2 . '</option>
                <option value="1">1 min</option>
                 <option value="2">2 min</option>
                 <option value="3">3 min</option>
                 <option value="4">4 min</option>
                 <option value="5">5 min</option>
                 <option value="6">6 min</option>
                 <option value="7">7 min</option>
                 <option value="8">8 min</option>
                 <option value="9">9 min</option>
                <option value="10">10 min</option>
                 <option value="11">11 min</option>
                 <option value="12">12 min</option>
                  <option value="13">13 min</option>
                  <option value="14">14 min</option>
                 <option value="15">15 min</option>
                 <option value="16">16 min</option>
                 <option value="17">17 min</option>
                  <option value="18">18 min</option>
                  <option value="19">19 min</option>
                  <option value="20">20 min</option>
                 </select>';
            })
            ->addColumn('sede', function ($data) {

                $db_sedes = Sedes::where('clientes_primarios_id_cliente_primario', $data->clientes_primarios_id_cliente_primario)->first();

                return $db_sedes->nome_sede;

                // $roleta_usuario = Roleta_Usuario::where('id_usuario', $data->id)->first();

                // if(!empty($roleta_usuario )){

                //     $roleta = Roleta::where('id', $roleta_usuario->id_roleta)->first();



                //     $sede = Sedes::where('clientes_primarios_id_cliente_primario', $roleta->id_sede)->first();

                //     return $sede->nome_sede;



                // }
            })
            ->rawColumns(['parte_roleta', 'tempo'])
            ->toJson();
    }

    public function datatable_roleta_usuarios()
    {


        $db_roleta = Roleta::where('id', request()->id_usuario)->first();



        $usuarios = DB::table('users')->where('clientes_primarios_id_cliente_primario', $db_roleta->id_cliente_primario);

        // $usuarios = DB::table('roleta_usuario')
        // ->where('cliente_primario', $db_roleta->id_cliente_primario)
        // ->where('id_roleta', $db_roleta->id)->whereNotNull('id_usuario')
        // ->orderBy('ordem', 'asc');



        return Datatables::of($usuarios)
            ->addColumn('nome_usuario', function ($data) {

                $usuario = Users::where('id', $data->id)->first();

                if (!empty($usuario->name)) {
                    return $usuario->name;
                } else {
                    return '';
                }
            })
            ->addColumn('email_usuario', function ($data) {

                $usuario = Users::where('id', $data->id)->first();

                if (!empty($usuario->email)) {
                    return $usuario->email;
                } else {
                    return '';
                }
            })

            ->addColumn('parte_roleta', function ($data) {

                $roleta_usuario =  Roleta_Usuario::where('cliente_primario', $data->clientes_primarios_id_cliente_primario)
                    ->where('id_roleta', request()->id_roleta)->where('id_usuario', $data->id)
                    ->whereNotNull('id_usuario')->orderBy('ordem', 'asc')->first();


                if (!empty($roleta_usuario)) {
                    return '<select class="" name="faz_parte_roleta" id="faz_parte_roleta">
                <option value="sim">SIM</option>
                 <option value="nao">NÃO</option>
                 </select>';
                } else {
                    return  '<select class="" name="faz_parte_roleta" id="faz_parte_roleta">
                    <option value="nao">NÃO</option>
                     <option value="sim">SIM</option>
                     </select>';
                }
            })
            ->addColumn('tempo', function ($data) {

                $roleta_usuario =  Roleta_Usuario::where('cliente_primario', $data->clientes_primarios_id_cliente_primario)
                    ->where('id_roleta', request()->id_roleta)->where('id_usuario', $data->id)
                    ->whereNotNull('id_usuario')->orderBy('ordem', 'asc')->first();



                if (!empty($roleta_usuario->tempo)) {

                    if ($roleta_usuario->tempo == 0) {

                        $valor = 0;
                        $valor_2 = 'Selecione';
                    } else {

                        $valor = $roleta_usuario->tempo;
                        $valor_2 = $roleta_usuario->tempo . ' min';
                    }
                } else {
                    $valor = 0;
                    $valor_2 = 'Selecione';
                }

                return '<select class="" name="tempo" id="tempo">
                 <option value="' . $valor . '">' . $valor_2 . '</option>
                <option value="1">1 min</option>
                 <option value="2">2 min</option>
                 <option value="3">3 min</option>
                 <option value="4">4 min</option>
                 <option value="5">5 min</option>
                 <option value="6">6 min</option>
                 <option value="7">7 min</option>
                 <option value="8">8 min</option>
                 <option value="9">9 min</option>
                <option value="10">10 min</option>
                 <option value="11">11 min</option>
                 <option value="12">12 min</option>
                  <option value="13">13 min</option>
                  <option value="14">14 min</option>
                 <option value="15">15 min</option>
                 <option value="16">16 min</option>
                 <option value="17">17 min</option>
                  <option value="18">18 min</option>
                  <option value="19">19 min</option>
                  <option value="20">20 min</option>
                 </select>';
            })
            ->addColumn('ordem', function ($data) {

                $qnt_ordens =  Users::where('clientes_primarios_id_cliente_primario', $data->clientes_primarios_id_cliente_primario)->get()->count();

                $roleta_usuario =  Roleta_Usuario::where('cliente_primario', $data->clientes_primarios_id_cliente_primario)
                    ->where('id_roleta', request()->id_roleta)->where('id_usuario', $data->id)
                    ->whereNotNull('id_usuario')->orderBy('ordem', 'asc')->first();



                $select = '<select class="" name="ordem" id="ordem">';
                if (!empty($roleta_usuario->tempo)) {
                    // Adicionar opção padrão
                    $select .= '<option value="' . $roleta_usuario->ordem . '">' . $roleta_usuario->ordem . '</option>';

                    // Adicionar opções com números de 1 até a quantidade obtida
                    for ($i = 1; $i <= $qnt_ordens; $i++) {
                        $select .= '<option value="' . $i . '">' . $i  . '</option>';
                    }

                    $select .= '</select>';
                } else {
                    // Adicionar opção padrão
                    $select .= '<option value="">Selecione</option>';

                    // Adicionar opções com números de 1 até a quantidade obtida
                    for ($i = 1; $i <= $qnt_ordens; $i++) {
                        $select .= '<option value="' . $i . '">' . $i  . '</option>';
                    }

                    $select .= '</select>';
                }



                return $select;
            })
            ->rawColumns(['parte_roleta', 'tempo', 'ordem'])
            ->toJson();
    }

    public function usuario_parte_roleta()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $roletaUsuario = Roleta_Usuario::where('id_roleta', request()->id_roleta)->where('id_usuario', request()->id_usuario)->first();


        if (request()->faz_parte_roleta == 'sim') {

            if(empty($roletaUsuario)){
                $roletaUsuario = new Roleta_Usuario();
            }

            $roletaUsuario->id_roleta = request()->id_roleta;
            $roletaUsuario->id_usuario = request()->id_usuario;

            if(empty($roletaUsuario->tempo)){
                $roletaUsuario->tempo = 15;
            }

            $roletaUsuario->ativo = 1;
            $roletaUsuario->cliente_primario =  $bd_users->clientes_primarios_id_cliente_primario;
            $roletaUsuario->save();
        } else {
            if ($roletaUsuario) {
                // Excluir o registro se ele existir
                $roletaUsuario->delete();
            }
        }


    }

    public function adicionar_tempo()
    {


        $roletaUsuario = Roleta_Usuario::where('id_roleta', request()->id_roleta)->where('id_usuario', request()->id_usuario)->first();

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        if (!empty($roletaUsuario)) {

            $roletaUsuario->id_roleta = request()->id_roleta;
            $roletaUsuario->id_usuario = request()->id_usuario;
            $roletaUsuario->cliente_primario =  $bd_users->clientes_primarios_id_cliente_primario;
            $roletaUsuario->ativo =  1;
            $roletaUsuario->tempo =  request()->tempo;
            $roletaUsuario->save();
        }
    }

    public function atualizar_roleta()
    {

        // dd(request()->all());

        // dd(request()->data_roleta);
        $dataRoleta = request()->data_roleta;
        $carbonDate = Carbon::parse($dataRoleta);

        $roleta = Roleta::where('id', request()->id_roleta)->first();
        $roleta->nome = request()->nome_roleta;
        $roleta->id_empreendimento = request()->empreendimento;
        $roleta->id_sede = request()->sede;
        $roleta->prazo =  $carbonDate->format('Y-m-d H:i:s');
        // $roleta->data_criacao = Carbon::now();
        $roleta->save();

        return response()->json([
            'status' => true,
            'message' => 'Atualizado com sucesso!',
        ]);
    }

    public function criar_roleta()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $usuarios = DB::table('users')->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();

        $dataRoleta = request()->data_roleta;
        $carbonDate = Carbon::parse($dataRoleta);

        $roleta = new Roleta();
        $roleta->id_empreendimento = request()->empreendimento;
        $roleta->nome = request()->nome_roleta;
        $roleta->id_sede = request()->sede;
        $roleta->prazo =  $carbonDate->format('Y-m-d H:i:s');
        $roleta->origem = request()->origem;
        $roleta->id_cliente_primario = $bd_users->clientes_primarios_id_cliente_primario;
        $roleta->dt_criacao = Carbon::now();
        $roleta->save();



        $ordem = 0;
        foreach ($usuarios as $usuario) {
            $ordem++;
            $roleta_usuarios = new Roleta_Usuario();
            $roleta_usuarios->id_roleta = $roleta->id;
            $roleta_usuarios->id_usuario = $usuario->id;
            $roleta_usuarios->cliente_primario = $usuario->clientes_primarios_id_cliente_primario;
            $roleta_usuarios->tempo = 15;
            $roleta_usuarios->ativo = 1;
            $roleta_usuarios->ordem = $ordem;
            $roleta_usuarios->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Roleta Criada com sucesso!',
        ]);
    }

    public function excluir_roleta()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $roleta = Roleta::where('id', request()->id)
            ->where('id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);

        if (!empty($roleta->first())) {

            $roleta->delete();
        }

        $roleta_usuarios = Roleta_Usuario::where('id', request()->id)
            ->where('cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);

        if (!empty($roleta_usuarios->first())) {

            $roleta->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Exclusão efetuada com sucesso!',
        ]);
    }

    public function atualizar_ordem()
    {

        $roleta_usuario = Roleta_Usuario::
        where('id_roleta', request()->id_roleta)
        ->where('id_usuario', request()->id_roleta_usuario)->first();

        $ordem_antiga = $roleta_usuario->ordem;
        $ordem_atual = request()->ordem;

        $roleta_usuario_2 = Roleta_Usuario::where('id_roleta', request()->id_roleta)->where('ordem', $ordem_atual)->first();

        if(!empty($roleta_usuario_2)){
            $roleta_usuario_2->ordem = $ordem_antiga;
            $roleta_usuario_2->save();
        }

        $roleta_usuario->ordem = $ordem_atual;
        $roleta_usuario->save();
    }
}
