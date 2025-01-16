<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Clientes_primarios extends Model
{
    use HasFactory;

    protected $table = 'clientes_primarios';
    public $timestamps = false;

    protected $primaryKey = "id_cliente_primario";

    protected $fillable = [
        'nome_cliente_primario', 'razao_cliente_primario','email_cliente_primario', 'ativo'
    ];


}