<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Usuarios extends Model
{
    use HasFactory;

    protected $table = 'usuarios';

    protected $primaryKey = "id_usuario";

    protected $fillable = [
        'nome_usuario', 'email_usuario', 'perfil_usuario', 'habilitado_usuario','clientes_primarios_id_cliente_primario'
    ];


    public $timestamps = false;

    function Clientes() {
        return $this->hasOne(Users::class, 'usuarios_id_usuario', 'id');
    }
}