<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Roleta_Usuario extends Model
{
    use HasFactory;

    protected $table = 'roleta_usuario';

    protected $primaryKey = "id";

    protected $fillable = [
        'id_roleta', 'id_usuario', 'cliente_primario', 'ativo', 'ordem', 'tempo', 'prazo'
    ];


    public $timestamps = false;


}