<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficha_compra extends Model
{
    use HasFactory;

    protected $table = 'ficha_compra';

    protected $primaryKey = 'id_form';

    protected $fillable = [
        'nome_firstbuyer',
        'sexo_firstbuyer',
        'filiacao_firstbuyer',
        'data_nasc_firstbuyer',
        'cpf_firstbuyer',
        'identidade_firstbuyer',
        'orgaoexpedidor_firstbuyer',
        'emissao_firstbuyer',
        'nacionalidade_firstbuyer',
        'estadocivil_firstbuyer',
        'endereco_firstbuyer',
        'numero_firstbuyer',
        'complemento_firstbuyer',
        'bairro_firstbuyer',
        'cidade_firstbuyer',
        'uf_firstbuyer',
        'cep_firstbuyer',
        'fone_residencial_firstbuyer',
        'fone_comercial_firstbuyer',
        'celular_firstbuyer',
        'email_firstbuyer',
        'profissao_firstbuyer',
        'cargo_firstbuyer',
        'admissao_firstbuyer',
        'fonterenda_firstbuyer',
        'nomeempresa_firstbuyer',
        'cnpj_firstbuyer',
        'rendaliquida_firstbuyer',
        'outrasrendas_firstbuyer',
        'outros_firstbuyer',
        'nome_secondbuyer',
        'sexo_secondbuyer',
        'filiacao_secondbuyer',
        'compra_venda_aquisicao',
        'financ_pretendido_aquisicao',
        'fgts_aquisicao',
        'prazo_aquisicao',
        'itbi_registro_aquisicao',
        'data_nasc_secondbuyer',
        'cpf_secondbuyer',
        'identidade_secondbuyer',
        'orgaoexpedidor_secondbuyer',
        'nacionalidade_secondbuyer',
        'emissao_secondbuyer',
        'estadocivil_secondbuyer',
        'endereco_secondbuyer',
        'numero_secondbuyer',
        'complemento_secondbuyer',
        'bairro_secondbuyer',
        'cidade_secondbuyer',
        'uf_secondbuyer',
        'cep_secondbuyer',
        'fone_residencial_secondbuyer',
        'fone_comercial_secondbuyer',
        'celular_secondbuyer',
        'email_secondbuyer',
        'profissao_secondbuyer',
        'cargo_secondbuyer',
        'admissao_secondbuyer',
        'fonterenda_secondbuyer',
        'nomeempresa_secondbuyer',
        'cnpj_secondbuyer',
        'rendaliquida_secondbuyer',
        'outrasrendas_secondbuyer',
        'outros_secondbuyer',
        'unidade_empreendimento',
        'data_registro',
        'status',
        'status_personalizado',
        'codigo_proposta',
        'usuarios_id_usuario',
        'empreendimentos_id_empreendimento',
        'clientes_primarios_id_cliente_primario',
    ];

    public $timestamps = false;
}
