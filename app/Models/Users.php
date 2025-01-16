<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Users extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $primaryKey = "id";

    protected $fillable = [
        'email', 'clientes_primarios_id_cliente_primario', 'telefone', 'img_perfil','img_perfil_url', 'logo_empresa', 'logo_empresa_url',
        'banco', 'tipo_conta', 'conta_banco', 'agencia', 'cpf', 'cep','endereco','numero','cidade', 'estado'
    ];


    public $timestamps = false;

    function Clientes() {
        return $this->hasOne(Users::class, 'usuarios_id_usuario', 'id');
    }

    function Clientes_primarios(){
        return $this->hasOne(Clientes_primarios::class, 'id_cliente_primario', 'clientes_primarios_id_cliente_primario');
    }
}