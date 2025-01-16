<?php

namespace App\Http\Controllers\Contratos\CadastroCompra;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ficha_compra;
use App\Models\Ct_proposta_compra;
use App\Models\Equipe;
use App\Mail\ConviteEmail;
use App\Models\Empreendimentos;
use Illuminate\Support\Facades\Mail;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use \Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;




class CadastroCompraController extends Controller
{

    function __construct() {}

    public function index()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();


        return view('contratos.cadastro_compras.vw-index', []);
    }


    public function datatable()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();
        $db = DB::table('Ct_proposta_compra')->where('id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario);

        return Datatables::of($db)
            ->addColumn('nome_corretor', function ($db) {

                $users = Users::where('id', $db->usuarios_id_usuario)->first();

                if (!empty($users)) {
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


    public function adicionar()
    {
        $bd_users =  Users::where('id', auth()->user()->id)->first();
        $empreendimentos = Empreendimentos::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->orderBy('nome_empreendimento', 'ASC')->get();

        $users = Users::where('clientes_primarios_id_cliente_primario', $bd_users->clientes_primarios_id_cliente_primario)->orderBy('name','ASC')->get();


        return view('contratos.cadastro_compras.vw-add', [
            'empreendimentos' => $empreendimentos,
            'corretores' => $users
        ]);
    }

    public function inserir()
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();

        $validator = Validator::make(request()->all(), [
            'corretor' => 'required',
            'empreendimento' => 'required',
            'unidade' => 'required',
            'nome1' => 'required',
            'sexo1' => 'required',
            'filiacao1' => 'required',
            'data_nascimento1' => 'required|date',
            'cpf1' => 'required',
            'rg1' => 'required',
            'orgao_expeditor1' => 'required',
            'emissao1' => 'required',
            'estado_civil1' => 'required',
            'nacionalidade1' => 'required',
            'cep1' => 'required',
            'endereco1' => 'required',
            'numero1' => 'required',
            'complemento1' => 'nullable', 
            'bairro1' => 'required',
            'cidade1' => 'required',
            'uf1' => 'required',
            'telefone_residencial1' => 'nullable',
            'telefone_comercial1' => 'nullable',
            'celular1' => 'required',
            'email1' => 'required|email',
            'profissao1' => 'required',
            'cargo1' => 'required',
            'data_admissao1' => 'required|date',
            'fonte_renda1' => 'required',
            'nome_empresa1' => 'required',
            'cnpj1' => 'required',
            'renda_liquida1' => 'required',
            'outra_fonte_renda1' => 'nullable', 
        ]);


        if ($validator->fails()) {

            $erros = [];
            
            foreach($validator->errors()->keys() as $field){

                if (is_numeric(substr($field, -1))) {
                    $field = str_replace('_', ' ', substr($field, 0, -1));
                }

                $field = ucwords($field);

                if($field == 'Cnpj' || $field == 'Cep' || $field == 'Cpf' || $field == 'Rg' ){

                    $field = strtoupper($field);

                }

                if($field == 'Endereco'){
                    $field = 'Endereço';
                }

                if($field == 'Filiacao'){
                    $field = 'Filiação';
                }

                if($field == 'Emissao'){
                    $field = 'Emissão';
                }

                if($field == 'Endereco'){
                    $field = 'Endereço';
                }

                if($field == 'Numero'){
                    $field = 'Número';
                }

                if($field == 'Profissao'){
                    $field = 'Profissão';
                }

                if($field == 'Data Admissao'){
                    $field = 'Data Admissão';
                }
                
                if($field == 'Renda Liquida'){
                    $field = 'Renda Liquida';
                }
                 $erros[] = 'Verificar ' . $field . ' do 1° Comprador';
   
            }

            return response()->json([
                'status' => false,
                'erros' => $erros
            ]);

        }

        $ct_proposta_compra = new Ct_proposta_compra();
        // $ct_proposta_compra->id_proposta = request()->codigo_proposta;
        $ct_proposta_compra->id_corretor = request()->corretor;
        $ct_proposta_compra->id_empreendimento = request()->empreendimento;
        $ct_proposta_compra->unidade = request()->unidade;
        $ct_proposta_compra->nome = request()->nome1;
        $ct_proposta_compra->sexo = request()->sexo1;
        $ct_proposta_compra->filiacao = request()->filiacao1;
        $ct_proposta_compra->data_nascimento = request()->data_nascimento1;
        $ct_proposta_compra->cpf = request()->cpf1;
        $ct_proposta_compra->rg = request()->rg1;
        $ct_proposta_compra->orgao_expeditor = request()->orgao_expeditor1;
        $ct_proposta_compra->rg_data_emissao = request()->emissao1;
        $ct_proposta_compra->estado_civil = request()->estado_civil1;
        $ct_proposta_compra->nacionalidade = request()->nacionalidade1;
        $ct_proposta_compra->cep = request()->cep1;
        $ct_proposta_compra->endereco = request()->endereco1;
        $ct_proposta_compra->numero = request()->numero1;
        $ct_proposta_compra->complemento = request()->complemento1;
        $ct_proposta_compra->bairro = request()->bairro1;
        $ct_proposta_compra->cidade = request()->cidade1;
        $ct_proposta_compra->uf = request()->uf1;
        $ct_proposta_compra->telefone_residencial = request()->telefone_residencial1;
        $ct_proposta_compra->telefone_comercial = request()->telefone_comercial1;
        $ct_proposta_compra->celular_comercial = request()->celular1;
        $ct_proposta_compra->email = request()->email1;
        $ct_proposta_compra->profissao = request()->profissao1;
        $ct_proposta_compra->cargo = request()->cargo1;
        $ct_proposta_compra->data_admissao = request()->data_admissao1;
        $ct_proposta_compra->fonte_renda_principal = request()->fonte_renda1;
        $ct_proposta_compra->nome_empresa = request()->nome_empresa1;
        $ct_proposta_compra->cnpj = request()->cnpj1;
        $ct_proposta_compra->renda_liquida = (float) str_replace(',', '.', str_replace('.', '',request()->renda_liquida1));
        $ct_proposta_compra->numero_comprador = 1;
        $ct_proposta_compra->id_cliente_primario =  $bd_users->clientes_primarios_id_cliente_primario;
        $ct_proposta_compra->id_usuario = $bd_users->id;
        $ct_proposta_compra->save();


        if(!empty(request()->nome2)){

            $validator = Validator::make(request()->all(), [
                'unidade' => 'required',
                'nome2' => 'required',
                'sexo2' => 'required',
                'filiacao2' => 'required',
                'data_nascimento2' => 'required|date',
                'cpf2' => 'required',
                'rg2' => 'required',
                'orgao_expeditor2' => 'required',
                'emissao2' => 'required',
                'estado_civil2' => 'required',
                'nacionalidade2' => 'required',
                'cep2' => 'required',
                'endereco2' => 'required',
                'numero2' => 'required',
                'complemento2' => 'nullable', 
                'bairro2' => 'required',
                'cidade2' => 'required',
                'uf2' => 'required',
                'telefone_residencial2' => 'nullable',
                'telefone_comercial2' => 'nullable',
                'celular2' => 'required',
                'email2' => 'required|email',
                'profissao2' => 'required',
                'cargo2' => 'required',
                'data_admissao2' => 'required|date',
                'fonte_renda2' => 'required',
                'nome_empresa2' => 'required',
                'cnpj2' => 'required',
                'renda_liquida2' => 'required|numeric',
                'outra_fonte_renda2' => 'nullable', 
            ]);


            if ($validator->fails()) {

                $erros = [];
                
                foreach($validator->errors()->keys() as $field){
    
                    if (is_numeric(substr($field, -1))) {
                        $field = str_replace('_', ' ', substr($field, 0, -1));
                    }
    
                    $field = ucwords($field);
    
                    if($field == 'Cnpj' || $field == 'Cep' || $field == 'Cpf' || $field == 'Rg' ){
    
                        $field = strtoupper($field);
    
                    }
    
                    if($field == 'Endereco'){
                        $field = 'Endereço';
                    }
    
                    if($field == 'Filiacao'){
                        $field = 'Filiação';
                    }
    
                    if($field == 'Emissao'){
                        $field = 'Emissão';
                    }
    
                    if($field == 'Endereco'){
                        $field = 'Endereço';
                    }
    
                    if($field == 'Numero'){
                        $field = 'Número';
                    }
    
                    if($field == 'Profissao'){
                        $field = 'Profissão';
                    }
    
                    if($field == 'Data Admissao'){
                        $field = 'Data Admissão';
                    }
                    
                    if($field == 'Renda Liquida'){
                        $field = 'Renda Liquida';
                    }
                     $erros[] = 'Verificar ' . $field . ' do 2° Comprador';
       
                }
    
                return response()->json([
                    'status' => false,
                    'erros' => $erros
                ]);
    
            }

            $ct_proposta_compra = new Ct_proposta_compra();
            // $ct_proposta_compra->id_proposta = request()->codigo_proposta;
            $ct_proposta_compra->id_corretor = request()->corretor;
            $ct_proposta_compra->id_empreendimento = request()->empreendimento;
            $ct_proposta_compra->unidade = request()->unidade2;
            $ct_proposta_compra->nome = request()->nome2;
            $ct_proposta_compra->sexo = request()->sexo2;
            $ct_proposta_compra->filiacao = request()->filiacao2;
            $ct_proposta_compra->data_nascimento = request()->data_nascimento2;
            $ct_proposta_compra->cpf = request()->cpf2;
            $ct_proposta_compra->rg = request()->rg2;
            $ct_proposta_compra->orgao_expeditor = request()->orgao_expeditor2;
            $ct_proposta_compra->emissao = request()->emissao2;
            $ct_proposta_compra->estado_civil = request()->estado_civil2;
            $ct_proposta_compra->nacionalidade = request()->nacionalidade2;
            $ct_proposta_compra->cep = request()->cep2;
            $ct_proposta_compra->endereco = request()->endereco2;
            $ct_proposta_compra->numero = request()->numero2;
            $ct_proposta_compra->complemento = request()->complemento2;
            $ct_proposta_compra->bairro = request()->bairro2;
            $ct_proposta_compra->cidade = request()->cidade2;
            $ct_proposta_compra->uf = request()->uf2;
            $ct_proposta_compra->telefone_residencial = request()->telefone_residencial2;
            $ct_proposta_compra->telefone_comercial = request()->telefone_comercial2;
            $ct_proposta_compra->celular = request()->celular2;
            $ct_proposta_compra->email = request()->email2;
            $ct_proposta_compra->profissao = request()->profissao2;
            $ct_proposta_compra->cargo = request()->cargo2;
            $ct_proposta_compra->data_admissao = request()->data_admissao2;
            $ct_proposta_compra->fonte_renda = request()->fonte_renda2;
            $ct_proposta_compra->nome_empresa = request()->nome_empresa2;
            $ct_proposta_compra->cnpj = request()->cnpj2;
            $ct_proposta_compra->renda_liquida = request()->renda_liquida2;
            $ct_proposta_compra->outra_fonte_renda = request()->outra_fonte_renda2;
            $ct_proposta_compra->numero_comprador = 2;
            $ct_proposta_compra->id_cliente_primario =  $bd_users->clientes_primarios_id_cliente_primario;
            $ct_proposta_compra->id_usuario = $bd_users->id;
            $ct_proposta_compra->save();

        }

        return response()->json([
            'status' => true,
            'message' => 'Inserido com sucesso!',
        ]);

    }
}
