<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Grupo_clientes_primarios extends Model
{
    use HasFactory;

    protected $table = 'grupo_clientes_primarios';

    protected $primaryKey = "id";
    public $timestamps = false;

    protected $fillable = [
        'id_cliente_primario', 'nome_cliente_primario','id_usuario', 'id_grupo'
    ];


    function Clientes_Primarios() {
        return $this->hasMany(Clientes_primarios::class, 'id_cliente_primario', 'id_cliente_primario');
    }


}