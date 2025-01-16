<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Ct_proposta_compra extends Model
{
    use HasFactory;

    protected $table = 'Ct_proposta_compra';

    protected $primaryKey = "id";

    protected $fillable = [
        'id_sede','id_empreendimento','unidade','nome','filiacao','sexo','data_nascimento','cpf','rg',
        'orgao_expeditor','rg_data_emissao','estado_civil','nacionalidade','cep','endereco','numero',
        'complemento','bairro','cidade','uf','telefone_residencial','telefone_comercial','celular_comercial',
        'email','profissao','cargo','data_admissao','fonte_renda_principal','nome_empresa','cnpj','renda_liquida',
        'outra_renda_reais','outra_renda_texto','numero_comprador',
    ];

    public $timestamps = false;
}
