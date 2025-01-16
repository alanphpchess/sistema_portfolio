<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Roleta extends Model
{
    use HasFactory;

    protected $table = 'roleta';

    protected $primaryKey = "id";

    protected $fillable = [
        'id', 'nome','id_cliente_primario', 'id_empreendimento','id_sede','dias', 'prazo',
        'id_fonte','data_criacao','roleta_atual'
    ];

    function Roleta_Usuario() {
        return $this->hasOne(roleta_usuario::class, 'id_roleta', 'id');
    }

    public $timestamps = false;


}