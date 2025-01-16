<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Empreendimentos extends Model
{
    use HasFactory;

    protected $table = 'empreendimentos';

    protected $primaryKey = "id_empreendimento";

    protected $fillable = [
        'id_empreendimento','nome_empreendimento','valor_empreendimento','bairro_empreendimento',
        'cidade_empreendimento','estado_empreendimento','tipo_id','clientes_primarios_id_cliente_primario',
        'codigo_imoveis','valor_locacao','valor_venda','email','telefone','cep','endereco','numero','complemento',	
        'referencia','zona','pais','finalidade','tipo','etapa','localizacao','torres','andares','elevadores','dormitorios',
        'suites','vagas','area_util','area_construida','area_terreno','area_total','descricao','anotacao','tipo_imovel','tipo_contrato'
    ];


    public $timestamps = false;
}