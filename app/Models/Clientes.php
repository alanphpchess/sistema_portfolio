<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Clientes extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $primaryKey = "id_cliente";

    protected $fillable = [
       'nome_cliente','telefone_cliente','email1_cliente',
        'email2_cliente','nome_conjuge_cliente','estado_civil_cliente','idade_cliente',
        'renda_cliente','filhos_cliente','fgts','endereco_cliente','numero_cliente','cep_cliente','bairro_cliente','cidade_cliente','valor_cliente',	
        'data_registro','data_atualizacao','data_criacao','data_lead','arquivado_cliente',
        'provedor_contato','empreendimento','unidade_empreendimento','local_empreendimento','tipologia','id_empreendimento',
        'status_id_status','usuarios_id_usuario','clientes_primarios_id_cliente_primario','visualizado','celular'  
    ];


    public $timestamps = false;

    function Empresas() {
        return $this->hasOne(empresas::class, 'clientes_primarios_id_cliente_primario', 'id_cliente');
    }

    function Empreendimentos() {
        return $this->hasOne(Empreendimentos::class, 'id_empreendimento', 'id_empreendimento');
    }

    function alertas() {
        return $this->hasOne(Alertas::class, 'id_cliente', 'id_cliente');
    }

    function Usuarios() {
        return $this->hasOne(Users::class, 'id', 'usuarios_id_usuario');
    }

    
    function Status() {
        return $this->hasOne(Status::class, 'id_status', 'status_id_status');
    }

    function Fontes() {
        return $this->hasOne(Fontes::class, 'id_fonte', 'fontes_id_fonte');
    }

    function Cli_gp_sedes_emp(){
        return $this->hasMany(Cli_gp_sedes_emp::class, 'id_cliente', 'id_cliente');
    }

    function Tags_clientes(){
        return $this->hasMany(Tags_clientes::class, 'cliente_id', 'id_cliente');
    }

    
}