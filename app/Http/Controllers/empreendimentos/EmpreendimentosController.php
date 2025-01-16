<?php

namespace App\Http\Controllers\empreendimentos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Empreendimentos;
use App\Models\Grupo_sede;
use App\Models\Sedes;
use App\Models\Permissoes;
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



class EmpreendimentosController extends Controller
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

        /// FIM PERMISSÕES

        return view('empreendimentos.vw-empreendimentos', [
            'permissoes' => $lista_permissao,
            'user_admin' => $user_admin
        ]);
    }

    public function adicionar()
    {
        $empreendimentos = Empreendimentos::count();
        $bd_users =  Users::where('id', auth()->user()->id)->first();



        $sedes = Sedes::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->get();


        return view('empreendimentos.vw-add-emp', [
            'sedes' => $sedes
        ]);
    }

    public function salvar()
    {



        if (empty(request()->nome)) {

            return response()->json([
                'status' => false,
                'message' => 'Campo nome do empreendimento é obrigatório!',
            ]);
        }

        if (empty(request()->sedes)) {

            return response()->json([
                'status' => false,
                'message' => 'Campo Sede é obrigatório!',
            ]);
        }


        $bd_users =  Users::where('id', auth()->user()->id)->first();
        $bd_empreendimentos = Empreendimentos::where('nome_empreendimento', request()->nome)->first();

        if (!empty($bd_empreendimentos)) {

            return response()->json([
                'status' => false,
                'message' => 'Nome do Empreendimento já existe',
            ]);
        } else {

            $bd_empreendimentos = new Empreendimentos();
        }

        $bd_empreendimentos->nome_empreendimento = request()->nome;
        $bd_empreendimentos->cep = request()->cep;
        $bd_empreendimentos->endereco = request()->endereco;
        $bd_empreendimentos->numero = request()->numero;
        $bd_empreendimentos->complemento = request()->complemento;
        $bd_empreendimentos->referencia = request()->referencia;
        $bd_empreendimentos->bairro_empreendimento = request()->bairro;
        $bd_empreendimentos->cidade_empreendimento = request()->cidade;
        $bd_empreendimentos->zona = request()->zona;
        $bd_empreendimentos->estado_empreendimento = request()->estado;
        $bd_empreendimentos->finalidade = request()->finalidade;
        $bd_empreendimentos->tipo_imovel = request()->tipo_imovel;
        $bd_empreendimentos->etapa = request()->etapa;
        $bd_empreendimentos->localizacao = request()->localizacao;
        $bd_empreendimentos->torres = request()->torres;
        $bd_empreendimentos->andares = request()->andares;
        $bd_empreendimentos->elevadores = request()->elevadores;
        $bd_empreendimentos->dormitorios = request()->dormitorios;
        $bd_empreendimentos->suites = request()->suites;
        $bd_empreendimentos->vagas = request()->vagas;
        $bd_empreendimentos->area_util = request()->area_util;
        $bd_empreendimentos->area_construida = request()->area_construida;
        $bd_empreendimentos->area_terreno = request()->area_terreno;
        $bd_empreendimentos->area_total = request()->area_total;
        $bd_empreendimentos->descricao = request()->descricao;
        $bd_empreendimentos->anotacao = request()->anotacao;
        $bd_empreendimentos->tipo_contrato = request()->tipo_contrato;
        $bd_empreendimentos->valor_locacao = request()->valor_locacao;
        $bd_empreendimentos->valor_empreendimento = request()->valor_venda;
        $bd_empreendimentos->email = request()->email;
        $bd_empreendimentos->telefone = request()->telefone;
        $bd_empreendimentos->tipo_id = request()->tipo_id;
        $bd_empreendimentos->clientes_primarios_id_cliente_primario = $bd_users->clientes_primarios_id_cliente_primario;

        $bd_empreendimentos->save();


        foreach (request()->sedes as $id_sede) {

            $bd_grupo_sedes = new Grupo_sede;
            $bd_grupo_sedes->id_sede = $id_sede;
            $bd_grupo_sedes->id_empreendimento = $bd_empreendimentos->id_empreendimento;
            $bd_grupo_sedes->id_cliente_primario = $bd_users->clientes_primarios_id_cliente_primario;
            $bd_grupo_sedes->save();
        }

        return response()->json([
            'status' => true,
            'message' => 'Salvo com sucesso!',
        ]);

    }

    public function datatable_empreendimentos()
    {


        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $db_empreendimentos = DB::table('empreendimentos')->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)
        ->orderBy('id_empreendimento', 'desc');
    
    
    



        return Datatables::of($db_empreendimentos)
            ->addColumn('sedes', function ($db_empreendimentos){
                
                $grupo_sedes = Grupo_sede::with('Sedes')->where('id_empreendimento', $db_empreendimentos->id_empreendimento)->get();

                $badge = '';

                foreach($grupo_sedes as $gp){

                    $badge .= '<span style="display: inline-block; padding: 5px 10px; background-color:#261758; color: #fff; border-radius: 20px; font-size: 12px; font-weight: bold; text-transform: uppercase;">' . $gp->sedes->nome_sede . '</span> ';


                }

                return $badge;

            })->addColumn('img_principal', function ($data) {

                $db_img_emp = Img_empreendimentos::where('id_empreendimento', $data->id_empreendimento)
                    ->where('img_principal', 1)->first();

                if (!empty($db_img_emp)) {
                    $img = '<a href="' . asset($db_img_emp->url_img) . '" data-lightbox="img_emp-' . $data->id_empreendimento . '" title="Visualizar"><img src="' . asset($db_img_emp->url_img) . '" style="width:100px;"></a>';
                    return $img;
                } else {
                    $img = '<img src="' . asset('image/default/datatable/predio.png') . '" style="width:50px;">';
                    return $img;
                }
            })
            ->addColumn('numeros_imgs', function ($data) {

                $numero_imgs = Img_empreendimentos::where('id_empreendimento', $data->id_empreendimento)
                    ->where('img_principal', 0)
                    ->whereNull('id_pasta')->count();

                if (!empty($numero_imgs)) {
                    $badge = '<a href="/admin/empreendimentos/galeria/' . $data->id_empreendimento . '"><div class="icon-badge-group"><div class="icon-badge-container"><i class="ri-image-fill icon-badge-icon"></i><div class="icon-badge">' . $numero_imgs . '</div></div></div></a>';
                } else {
                    $badge = '<div class="icon-badge-group"><div class="icon-badge-container"><i class="ri-image-fill icon-badge-icon"></i><div class="icon-badge">' . $numero_imgs . '</div></div></div>';
                }

                return $badge;
            })
            ->addColumn('arquivos', function ($data) {

                $numero_imgs = Img_empreendimentos::where('id_empreendimento', $data->id_empreendimento)
                    ->whereNotNull('id_pasta')->count();

                $badge = '<a href="/admin/empreendimentos/pastas/' . $data->id_empreendimento . '"><div class="icon-badge-group"><div class="icon-badge-container"><i class="ri-folder-3-line icon-badge-icon"></i><div class="icon-badge">' . $numero_imgs . '</div></div></div></a>';

                return $badge;
            })
            ->addColumn('action', function ($data) {

                $bd_users =  Users::where('id', auth()->user()->id)->first();

                $permissoes_editar = Permissoes::where('id_usuario', $bd_users->id)->where('nome', 'funcao_edit_emp')
                    ->first();

                // if ($bd_users->permissao == 'Administrador') {
                $btn_editar = '<a href="/admin/empreendimentos/editar/' . $data->id_empreendimento . '" class="bttn-material-flat bttn-xs bttn-success"><i class="fa fa-edit"></i> Editar</a>';
                // } else if (!empty($permissoes_editar)) {

                //     if ($permissoes_editar->ativo == 'true') {
                //         $btn_editar = '<a href="/admin/empreendimentos/editar/' . $data->id_empreendimento . '" class="bttn-material-flat bttn-xs bttn-success"><i class="fa fa-edit"></i> Editar</a>';
                //     } else {

                //         $btn_editar = '';
                //     }
                // } else {
                //     $btn_editar = '';
                // }



                $permissoes_add_imagem = Permissoes::where('id_usuario', $bd_users->id)->where('nome', 'funcao_adicionar_imagens_emp')
                    ->first();

                // if ($bd_users->permissao == 'Administrador') {
                $btn_add_img = '<a href="/admin/empreendimentos/adicionar_imagem/' . $data->id_empreendimento . '" class="bttn-material-flat bttn-xs bttn-primary"><i class=" ri-image-add-fill"></i> Imagem</a>';
                // } else if (!empty($permissoes_add_imagem)) {

                //     if ($permissoes_add_imagem->ativo == 'true' || $bd_users->permissao == 'Administrador') {
                //         $btn_add_img = '<a href="/admin/empreendimentos/adicionar_imagem/' . $data->id_empreendimento . '" class="bttn-material-flat bttn-xs bttn-primary"><i class=" ri-image-add-fill"></i> Imagem</a>';
                //     } else {
                //         $btn_add_img = '';
                //     }
                // } else {
                //     $btn_add_img = '';
                // }

                $permissoes_excluir = Permissoes::where('id_usuario', $bd_users->id)->where('nome', 'funcao_excluir_emp')
                    ->first();

                // if ($bd_users->permissao == 'Administrador') {
                $btn_excluir = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-emp" data-target="' . $data->id_empreendimento . '"><i class="ri-delete-bin-5-line"></i> Excluir</button>';
                // } else if (!empty($permissoes_excluir)) {

                //     if ($permissoes_excluir->ativo == 'true' || $bd_users->permissao == 'Administrador') {
                //         $btn_excluir = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-emp" data-target="' . $data->id_empreendimento . '"><i class="ri-delete-bin-5-line"></i> Excluir</button>';
                //     } else {
                //         $btn_excluir = '';
                //     }
                // } else {
                //     $btn_excluir = '';
                // }

                return  $btn_add_img . '  ' . $btn_editar . '  ' . $btn_excluir;
            })
            ->rawColumns(['action', 'img_principal', 'numeros_imgs', 'arquivos','sedes'])
            ->toJson();
    }

    public function editar($id)
    {
        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;

        $db_empreendimentos = Empreendimentos::where('id_empreendimento', request()->id)
            ->where('clientes_primarios_id_cliente_primario', $cliente_primario)
            ->first();


        if (empty($db_empreendimentos)) {
            return view('erros_page.404', []);
        }


        if (!empty($db_empreendimentos)) {

            return view('empreendimentos.vw-edit-emp', [
                'empreendimento' => $db_empreendimentos
            ]);
        }
    }

    public function atualizar()
    {
        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;

        $bd_empreendimentos = Empreendimentos::where('id_empreendimento', request()->id)
            ->where('clientes_primarios_id_cliente_primario', $cliente_primario)
            ->first();


        if (empty($bd_empreendimentos)) {
            return view('erros_page.404', []);
        }

        $bd_empreendimentos->nome_empreendimento = request()->nome;
        $bd_empreendimentos->cep = request()->cep;
        $bd_empreendimentos->endereco = request()->endereco;
        $bd_empreendimentos->numero = request()->numero;
        $bd_empreendimentos->complemento = request()->complemento;
        $bd_empreendimentos->referencia = request()->referencia;
        $bd_empreendimentos->bairro_empreendimento = request()->bairro;
        $bd_empreendimentos->cidade_empreendimento = request()->cidade;
        $bd_empreendimentos->zona = request()->zona;
        $bd_empreendimentos->estado_empreendimento = request()->estado;
        $bd_empreendimentos->finalidade = request()->finalidade;
        $bd_empreendimentos->tipo_imovel = request()->tipo_imovel;
        $bd_empreendimentos->etapa = request()->etapa;
        $bd_empreendimentos->localizacao = request()->localizacao;
        $bd_empreendimentos->torres = request()->torres;
        $bd_empreendimentos->andares = request()->andares;
        $bd_empreendimentos->elevadores = request()->elevadores;
        $bd_empreendimentos->dormitorios = request()->dormitorios;
        $bd_empreendimentos->suites = request()->suites;
        $bd_empreendimentos->vagas = request()->vagas;
        $bd_empreendimentos->area_util = request()->area_util;
        $bd_empreendimentos->area_construida = request()->area_construida;
        $bd_empreendimentos->area_terreno = request()->area_terreno;
        $bd_empreendimentos->area_total = request()->area_total;
        $bd_empreendimentos->descricao = request()->descricao;
        $bd_empreendimentos->anotacao = request()->anotacao;
        $bd_empreendimentos->tipo_contrato = request()->tipo_contrato;
        $bd_empreendimentos->valor_locacao = request()->valor_locacao;
        $bd_empreendimentos->valor_empreendimento = request()->valor_venda;
        $bd_empreendimentos->email = request()->email;
        $bd_empreendimentos->telefone = request()->telefone;
        $bd_empreendimentos->tipo_id = request()->tipo_id;


        if ($bd_empreendimentos->save()) {
            return response()->json([
                'status' => true,
                'message' => 'Atualizado com sucesso!',
            ]);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Erro ao atualizar!',
            ]);
        }
    }

    public function excluir()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $db_empreendimentos = Empreendimentos::where('id_empreendimento', request()->id)
            ->where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);

        if (!empty($db_empreendimentos->first())) {

            $db_empreendimentos->delete();

            return response()->json([
                'status' => true,
                'message' => 'Exclusão efetuada com sucesso!',
            ]);
        }
    }

    public function add_img($id)
    {

        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;

        $db_empreendimento = Empreendimentos::where('id_empreendimento', $id)
            ->where('clientes_primarios_id_cliente_primario', $cliente_primario)
            ->first();

        if (empty($db_empreendimento)) {
            return view('erros_page.404', []);
        }

        return view('empreendimentos.vw-add-img', [
            'id_empreendimento' => $id
        ]);
    }

    public function upload_img($id)
    {

        if (request()->hasFile('files')) {

            $file = request()->file('files');

            $caminho_imagem = 'upload/empreendimentos/' . $id . '/';
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

            $bd_img = new Img_empreendimentos();
            $bd_img->url_img = $caminho_imagem . $nome_do_arquivo;
            $bd_img->nome = $nome_do_arquivo;
            $bd_img->nome_original = $nome_arquivo_original;
            $bd_img->id_empreendimento = $id;
            $bd_img->img_principal = 0;
            $bd_img->save();
        }
    }

    public function upload_img_principal($id)
    {

        if (request()->hasFile('files')) {

            $db_img_emp = Img_empreendimentos::where('id_empreendimento', $id)
                ->where('img_principal', 1);
            if (!empty($db_img_emp->first())) {
                $caminho_pasta = public_path('upload/empreendimentos/' . $id . '/img_principal');
                $db_img_emp->delete();
                File::deleteDirectory($caminho_pasta);
            }

            $file = request()->file('files');

            $caminho_imagem = 'upload/empreendimentos/' . $id . '/img_principal';
            $nome_do_arquivo = $file->getClientOriginalName();






            $extensao_do_arquivo = pathinfo($nome_do_arquivo, PATHINFO_EXTENSION);

            // Procura por um nome de arquivo único


            $nome_arquivo_original = $nome_do_arquivo;


            $nome_do_arquivo = Str::random(30) . '.' . $extensao_do_arquivo;




            $file->move(public_path($caminho_imagem), $nome_do_arquivo);

            // Constrói a URL do arquivo a partir do caminho relativo
            $url_imagem = url($caminho_imagem . $nome_do_arquivo);

            $bd_img = new Img_empreendimentos();
            $bd_img->url_img = $caminho_imagem . '/' . $nome_do_arquivo;
            $bd_img->nome = $nome_do_arquivo;
            $bd_img->nome_original = $nome_arquivo_original;
            $bd_img->id_empreendimento = $id;
            $bd_img->img_principal = 1;
            $bd_img->save();
        }
    }

    public function galeria($id)
    {

        $db_img_emp = Img_empreendimentos::where('id_empreendimento', $id)
            ->where('img_principal', 0);

        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;

        $db_empreendimentos = Empreendimentos::where('id_empreendimento', $id)
            ->where('clientes_primarios_id_cliente_primario', $cliente_primario)
            ->first();

        if (empty($db_empreendimentos)) {
            return view('erros_page.404', []);
        }



        return view('empreendimentos.vw-emp-galeria', [
            'id_empreendimento' => $id,
            'paginacao' => $db_img_emp->paginate(10),
            'imagens' => $db_img_emp->get()
        ]);
    }

    public function arquivos($id)
    {
        $bd_categoria_pasta = Cat_pasta_emp::where('id', $id)->first();

        return view('empreendimentos.vw-emp-arquivos', [
            'id_pasta' => $id,
            'id_empreendimento' => $bd_categoria_pasta->id_empreendimento
        ]);
    }

    public function datatable_emp_arquivos(Request $request)
    {
        $id = $request->input('id');

        $db_img_emp = DB::table('img_empreendimentos')->where('id_empreendimento', $id);

        return Datatables::of($db_img_emp)

            ->addColumn('arquivo', function ($data) {
                $img = '<a href="' . asset($data->url_img) . '" data-lightbox="img_emp-' . $data->id_empreendimento . '" title="Visualizar"><img src="' . asset($data->url_img) . '" style="width:50px;height:50px;object-fit:cover;"></a>';
                return $img;
                return '';
            })
            ->addColumn('action', function ($data) {
                $btn_download = '<a href="/admin/empreendimentos/download/' . $data->id . '" target="_blank"><button class="bttn-material-flat bttn-xs bttn-success btn-excluir-emp" data-target="' . $data->id . '"><i class="dripicons-download"></i> Download</button></a>';
                $btn_excluir = '<button class="bttn-material-flat bttn-xs bttn-danger btn-excluir-emp" data-target="' . $data->id . '"><i class="ri-delete-bin-5-line"></i> Excluir</button>';
                return  $btn_download . ' ' . $btn_excluir;
            })
            ->rawColumns(['action', 'arquivo'])
            ->toJson();
    }

    public function download($id)
    {

        $db_img_emp = Img_empreendimentos::where('id', $id)->first();

        $filePath = public_path($db_img_emp->url_img);

        return response()->download($filePath);
    }

    public function excluir_arquivo()
    {
        $bd_img_emp = Img_empreendimentos::where('id', request()->id)->get();

        if ($bd_img_emp->isEmpty()) {
            return response()->json([
                'status' => false,
                'message' => 'Nenhum registro encontrado para o ID fornecido.',
            ], 404);
        }

        foreach ($bd_img_emp as $imagem) {
            $caminho_arquivo = public_path($imagem->url_img);

            // Verifica se o arquivo existe
            if (file_exists($caminho_arquivo)) {
                // Remove o arquivo do sistema de arquivos
                unlink($caminho_arquivo);
            }

            // Exclui o registro do banco de dados
            $imagem->delete();
        }

        return response()->json([
            'status' => true,
            'message' => 'Registros excluídos com sucesso!',
        ]);
    }

    public function gerenciar_pasta($id_empreendimento)
    {
        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;

        $db_empreendimentos = Empreendimentos::where('id_empreendimento', $id_empreendimento)
            ->where('clientes_primarios_id_cliente_primario', $cliente_primario)
            ->first();


        if (empty($db_empreendimentos)) {
            return view('erros_page.404', []);
        }

        $opcoes_pastas = Pastas::get();
        return view('empreendimentos.vw-gerenciar_pasta', [
            'opcoes_pastas' => $opcoes_pastas,
            'id_empreendimento' => $id_empreendimento
        ]);
    }

    public function datatable_emp_ger_pastas(Request $request)
    {
        $id = $request->input('id');

        $db_img_emp = DB::table('cat_pasta_emp')->where('id_empreendimento', $id);

        return Datatables::of($db_img_emp)
            ->addColumn('url', function ($data) {
                $pasta = Pastas::where('id', $data->id_pasta)->first();
                $img = '<div style="display:flex;justify-content:center;"><img src="' . asset($pasta->url) . '" style="width:40px;"></div>';
                return  $img;
            })
            ->addColumn('arquivos', function ($data) {

                $numero_imgs = Img_empreendimentos::where('id_pasta', $data->id)->count();


                $badge = '<div style="display:flex;justify-content:center;"><a href="/admin/empreendimentos/arquivos/' . $data->id . '"><div class="icon-badge-group"><div class="icon-badge-container"><i class="ri-folder-3-line icon-badge-icon"></i><div class="icon-badge">' . $numero_imgs . '</div></div></div></a></div>';


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

    public function add_pasta()
    {

        $bd_categoria_pasta = new Cat_pasta_emp();

        $bd_categoria_pasta->descricao = request()->descricao;
        $bd_categoria_pasta->nome = request()->nome;
        $bd_categoria_pasta->id_empreendimento = request()->id_empreendimento;
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

    public function edit_pasta()
    {

        $bd_categoria_pasta = Cat_pasta_emp::where('id', request()->id)->first();


        $bd_categoria_pasta->descricao = request()->descricao;
        $bd_categoria_pasta->nome = request()->nome;
        $bd_categoria_pasta->id_empreendimento = request()->id_empreendimento;
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

        $bd_categoria_pasta = Cat_pasta_emp::where('id', request()->id)->first();

        if (!empty($bd_categoria_pasta->first())) {

            $bd_categoria_pasta->delete();

            return response()->json([
                'status' => true,
                'message' => 'Exclusão efetuada com sucesso!',
            ]);
        }
    }

    public function gerenciar_arquivos($id)
    {
        $bd_categoria_pasta = Cat_pasta_emp::where('id', $id)->first();



        return view('empreendimentos.vw-gerenciar-arquivos', [
            'id_pasta' => $id,
            'id_empreendimento' => $bd_categoria_pasta->id_empreendimento
        ]);
    }

    public function datatable_emp_arq_2(Request $request)
    {

        $id = $request->input('id');


        $db_img_emp = DB::table('img_empreendimentos')->where('id_pasta', $id);

        return Datatables::of($db_img_emp)
            ->addColumn('arquivos', function ($data) {


                $extensoes =  array('.pdf', '.txt', '.doc', '.avi', '.bmp', '.csv', '.docx', '.epub', '.mobi', '.mov', '.mp3', '.mp4', '.ppt', '.pptx', '.rtf', '.wav', '.wmv', '.xls', '.xlsx');

                foreach ($extensoes as $extensao) {


                    if (strpos($data->nome_original, $extensao) !== false) {

                        $img = '<div class="text-center"><img src="' . asset('image/default/arquivos/' . strtoupper(str_replace('.', '', $extensao)) . '.png') . '" style="width:70px;height:70px"></div>';
                        return $img;
                    }
                }


                $img = '<div class="text-center"><a href="' . asset($data->url_img) . '" data-lightbox="img_emp-' . $data->id . '" title="Visualizar"><img src="' . asset($data->url_img) . '" style="width:80px;"></a></div>';
                return $img;
            })
            ->addColumn('action', function ($data) {
                $btn_download = '<a href="/admin/empreendimentos/download/' . $data->id . '" target="_blank"><button class="bttn-material-flat bttn-xs bttn-success btn-excluir-emp" data-target="' . $data->id . '"><i class="dripicons-download"></i> Download</button></a>';
                $btn_excluir = '<button class="bttn-material-flat bttn-xs bttn-danger btn-emp-excluir-arquivo" data-target="' . $data->id . '"><i class="ri-delete-bin-5-line"></i> Excluir</button>';
                return $btn_download . " " . $btn_excluir;
            })
            ->rawColumns(['action', 'arquivos'])
            ->toJson();
    }

    public function upload_arquivos($id, $id_empreendimento)
    {

        if (request()->hasFile('files')) {

            $file = request()->file('files');

            $caminho_imagem = 'upload/empreendimentos/pastas/' . $id . '/';
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

            $bd_img = new Img_empreendimentos();
            $bd_img->url_img = $caminho_imagem . $nome_do_arquivo;
            $bd_img->nome = $nome_do_arquivo;
            $bd_img->nome_original = $nome_arquivo_original;
            $bd_img->id_empreendimento = $id_empreendimento;
            $bd_img->id_pasta = $id;
            $bd_img->img_principal = 0;
            $bd_img->save();
        }
    }

    public function pastas($id)
    {

        $grupos_pastas = Cat_pasta_emp::where('id_empreendimento', $id)->with('pasta');
        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $cliente_primario =  Users::where('id', auth()->user()->id)->first()->clientes_primarios_id_cliente_primario;

        $db_empreendimentos = Empreendimentos::where('id_empreendimento', $id)
            ->where('clientes_primarios_id_cliente_primario', $cliente_primario)
            ->first();

        if (empty($db_empreendimentos)) {
            return view('erros_page.404', []);
        }


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

        return view('empreendimentos.vw-pastas', [
            'grupos_pastas' => $grupos_pastas->get(),
            'paginacao' => $grupos_pastas->paginate(10),
            'id_empreendimento' => $id,
            'permissoes' => $lista_permissao,
            'user_admin' => $user_admin
        ]);
    }

    public function pastas_arquivos($id)
    {


        $arquivos = Img_empreendimentos::where('id_pasta', $id);


        return view('empreendimentos.vw-arquivos', [
            'arquivos' => $arquivos->get(),
            'paginacao' => $arquivos->paginate(10),
        ]);
    }
}
