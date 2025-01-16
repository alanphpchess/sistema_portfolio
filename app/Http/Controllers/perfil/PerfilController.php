<?php

namespace App\Http\Controllers\perfil;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Convites;
use App\Models\Equipe;
use App\Models\Empresas;
use App\Models\Permissoes;
use App\Mail\ConviteEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;




class PerfilController extends Controller
{

    function __construct()
    {
    }

    public function index()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();


        return view('perfil.vw-index', [
            'user' => $bd_users
        ]);
    }

    public function vw_permissao()
    {
        $bd_users =  Users::where('id', request()->codigo_ativacao)->first();

        /// PERMISSÕES 
        $permissoes = Permissoes::where('id_usuario', request()->codigo_ativacao)->get();

        $lista_permissao = [];
        foreach ($permissoes as $permissao) {
            $lista_permissao[$permissao->nome] = $permissao->ativo;
        }

        /// FIM PERMISSÕES

        return view('perfil.vw-permissao', [
            'id_usuario' => $bd_users->id,
            'permissao' => $lista_permissao
        ]);
    }

    public function atualizar()
    {


        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $bd_users->name = request()->nome;
        $bd_users->telefone = request()->telefone;
        $bd_users->celular = request()->celular;
        $bd_users->cpf = request()->cpf; 
        $bd_users->creci = request()->creci;
        $bd_users->cep = request()->cep;
        $bd_users->endereco = request()->endereco;
        $bd_users->numero = request()->numero;
        $bd_users->cidade = request()->cidade;
        $bd_users->banco = request()->banco;
        $bd_users->tipo_conta = request()->tipo_conta;
        $bd_users->conta_banco = request()->conta_banco;
        $bd_users->agencia = request()->agencia;
        $bd_users->estado = request()->estado;

        

        if (request()->hasFile('foto_perfil')) {

            $file = request()->file('foto_perfil');

            $caminho_imagem = 'upload/img_perfil/' . $bd_users->id . '/';
            $nome_do_arquivo = $file->getClientOriginalName();

            // Obtém todos os arquivos na pasta
            $arquivos = glob(public_path($caminho_imagem) . '*');


            // Itera sobre os arquivos e os exclui
            foreach ($arquivos as $arquivo) {
                if (is_file($arquivo)) {
                    unlink($arquivo);
                }
            }


            if (file_exists(public_path($caminho_imagem . $nome_do_arquivo))) {

                $extensao_do_arquivo = pathinfo($nome_do_arquivo, PATHINFO_EXTENSION);

                // Procura por um nome de arquivo único
                while (file_exists(public_path($caminho_imagem . $nome_do_arquivo))) {
                    $nome_do_arquivo = Str::random(30) . '.' . $extensao_do_arquivo;
                }
            } else {
                $nome_arquivo_original = $nome_do_arquivo;
            }

            $file->move(public_path($caminho_imagem), $nome_do_arquivo);


            $bd_users->img_perfil = $nome_do_arquivo;
            $bd_users->img_perfil_url = $caminho_imagem . $nome_do_arquivo;
        }
    

        if (request()->hasFile('logo_empresa')) {

 

            $file = request()->file('logo_empresa');

            $caminho_imagem = 'upload/logo_empresa/' . $bd_users->id . '/';
            $nome_do_arquivo = $file->getClientOriginalName();

            // Obtém todos os arquivos na pasta
            $arquivos = glob(public_path($caminho_imagem) . '*');


            // Itera sobre os arquivos e os exclui
            foreach ($arquivos as $arquivo) {
                if (is_file($arquivo)) {
                    unlink($arquivo);
                }
            }


            if (file_exists(public_path($caminho_imagem . $nome_do_arquivo))) {

                $extensao_do_arquivo = pathinfo($nome_do_arquivo, PATHINFO_EXTENSION);

                // Procura por um nome de arquivo único
                while (file_exists(public_path($caminho_imagem . $nome_do_arquivo))) {
                    $nome_do_arquivo = Str::random(30) . '.' . $extensao_do_arquivo;
                }
            } else {
                $nome_arquivo_original = $nome_do_arquivo;
            }

            $file->move(public_path($caminho_imagem), $nome_do_arquivo);


            $bd_users->logo_empresa = $nome_do_arquivo;
            $bd_users->logo_empresa_url = $caminho_imagem . $nome_do_arquivo;
        }

        $bd_users->save();

        return response()->json([
            'status' => true,
            'message' => 'Atualização efetuada com sucesso!',
        ]);
    }

    public function permissao_atualizar()
    {
        $permissoes = Permissoes::where('id_usuario', request()->id_usuario)
            ->where('nome', request()->funcionalidade)
            ->first();

        if (empty($permissoes)) {

            $permissoes = new Permissoes();
        }

        $permissoes->id_usuario = request()->id_usuario;
        $permissoes->nome = request()->funcionalidade;
        $permissoes->ativo = request()->ativo;
        $permissoes->save();
    }
}
