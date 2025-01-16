<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Contatos_realizados extends Model
{
    use HasFactory;

    protected $table = 'contatos_realizados';

    protected $primaryKey = "id";

    protected $fillable = [
        'data', 'horario','comunicacao', 'obs_contato','id_cliente','id_usuario','id_cliente_primario'
    ];


    public $timestamps = false;
}