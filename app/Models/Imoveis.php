<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imoveis extends Model
{
    use HasFactory;

    protected $table = 'imoveis';

    protected $primaryKey = "codigo_imoveis";

    protected $fillable = [
        'id_imoveis', 'codigo_imoveis', 'ref_imoveis', 'data_imoveis', 'data_atualizacao', 'titulo_imoveis', 'valor_imoveis', 'imagem_imoveis',
        'video_imoveis', 'tourvirtual_imoveis', 'descricao_imoveis', 'tag_imoveis', 'area_m2_imoveis', 'iptu_imoveis', 'condominio_imoveis', 'quartos_imoveis',
        'banheiros_imoveis', 'vagas_imoveis', 'telefone_imoveis', 'endereco_imoveis', 'cep_imoveis', 'lougradouro_imoveis', 'numero_imoveis', 'complemento_imoveis', 'bairro_imoveis', 
        'cidade_imoveis','estado_imoveis','latitude_imoveis', 'longitude_imoveis', 'status_imoveis', 'finalizado_imoveis', 'diretorio_imoveis', 'block_info', 'home_imoveis',
        'usuarios_id_usuarios','clientes_id_usuarios','tipo_imovel_id_tipo_imovel','qualquer_tipo_id_qualquer_tipo','tipo_anuncio_id_tipo_anuncio','valor_locacao','destaque_ativo',
        'destaque_','destaque_bairro','destaque_cep','destaque_cidade','destaque_descricao','destaque_rua','destaque_tipo','destaque_titulo','destaque_uf','status_integracao',
        'status_destaque','status_s_destaque','id_empreendimento','zap_s_destaque'
    ];


    public $timestamps = false;
}