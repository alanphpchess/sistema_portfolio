<?php

namespace App\Http\Controllers\tags;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Convites;
use App\Models\Equipe;
use App\Models\Tags;
use App\Models\Tags_clientes;
use App\Models\Empresas;
use App\Mail\ConviteEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\Facades\DataTables;




class TagsController extends Controller
{

    public function index()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        if ($bd_users->perfil_usuario != 1) {
            return view('erros_page.404', []);
        }

        return view('tags.vw-tags', []);
    }

    public function datatable_tags()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();
        $clientePrimarioId = $bd_users->clientes_primarios_id_cliente_primario;

        $subquery = DB::table('tags')
            ->select('titulo', DB::raw('MIN(id) as id'), 'cor')
            ->where('cliente_primario_id', $clientePrimarioId)
            ->groupBy('titulo', 'cor');

        $db_tags = DB::table(DB::raw("({$subquery->toSql()}) as unique_tags"))
            ->mergeBindings($subquery)
            ->get();

        return Datatables::of($db_tags)
            ->addColumn('cor', function ($db_tags) {
                $cor = $db_tags->cor;
                return '<center><div data-target="' . htmlspecialchars($cor) . '" style="width: 20px; height: 20px; background-color: ' . htmlspecialchars($cor) . '; border: 1px solid #000;"></div></center>';
            })
            ->addColumn('color_original', function ($db_tags) {
                return $db_tags->cor;
            })
            ->addColumn('action', function ($db_tags) {
                $btn_edit_sede = '<button class="bttn-material-flat bttn-xs bttn-success btn-editar-tags" data-target="' . $db_tags->id . '"> EDITAR</button>';
                $btn_remover_adm = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-tags" data-target="' . $db_tags->id . '"> EXCLUIR</button>';
                return  $btn_edit_sede . " " . $btn_remover_adm;
            })
            ->rawColumns(['action', 'cor'])
            ->toJson();
    }

    public function editar()
    {

        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;
        $tags = Tags::where('id', request()->id)
            ->where('cliente_primario_id', $cliente_primario)->first();

        $tags_titulos = TAGS::where('titulo', $tags->titulo)->where('cliente_primario_id', $cliente_primario)->get();


        if (!empty($tags_titulos)) {

            foreach ($tags_titulos as $tag_titulo) {
                $tag_titulo->titulo = request()->nome;
                $tag_titulo->cor = request()->cor;
                $tag_titulo->save();
            }


            return response()->json([
                'tags' => true,
                'message' => 'Atualizado com sucesso!',
            ]);
        }
    }

    public function adicionar()
    {

        $cliente_primario = Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;

        $tags = Tags::where('titulo', request()->nome)->where('cliente_primario_id', $cliente_primario)->first();


        if (empty(request()->nome)) {
            return response()->json([
                'tags' => false,
                'message' => 'Nome está vazio, favor preencher',
            ]);
        }

        if (!empty($tags)) {

            return response()->json([
                'tags' => false,
                'message' => 'Nome já existe, favor escolher outro!',
            ]);
        } else {

            $tags = new Tags();
            $tags->titulo = request()->nome;
            $tags->cliente_primario_id =  $cliente_primario;
            $tags->cor = request()->cor;
            $tags->save();

            return response()->json([
                'tags' => true,
                'message' => 'Salvo com sucesso!',
            ]);
        }
    }

    public function excluir()
    {

        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;


        $tags = Tags::where('id', request()->id)
            ->where('cliente_primario_id', $cliente_primario);

        $tags_titulos = TAGS::where('titulo', $tags->first()->titulo)->where('cliente_primario_id', $cliente_primario)->get();


        if (!empty($tags->first())) {

            foreach ($tags_titulos as $tag_titulo) {

                Tags_clientes::where('id', $tag_titulo->id)->delete();

                $tag_titulo->delete();
            }

            $tags->delete();

            return response()->json([
                'tags' => true,
                'message' => 'Exclusão efetuada com sucesso!',
            ]);
        }
    }
}
