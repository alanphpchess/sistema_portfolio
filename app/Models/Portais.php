<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Portais extends Model
{
    use HasFactory;

    protected $table = 'email_contato';

    protected $primaryKey = "id";

    protected $fillable = [
        'nome', 'email','telefone', 'mensagem','tag','horario_registro', 'data_registro',
        'site','id_fonte', 'id_empreendimento', 'id_usuario', 'id_cliente_primario',
        'visualizado', 'roleta', 'data_roleta', 'data_criacao', 'id_roleta', 'tipo'
    ];


    public $timestamps = false;


}