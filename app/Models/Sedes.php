<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Sedes extends Model
{
    use HasFactory;

    protected $table = 'sedes';

    protected $primaryKey = "id_sede";

    protected $fillable = [
        'nome_sede',
        'cnpj_sede','telefone_sede', 
        'celular_sede','cep_sede', 
        'logradouro_sede', 'numero_sede', 
        'numero_sede', 'cidade_sede',
        'estado_sede', 'banco_sede', 
        'tipo_conta_sede', 'conta_sede', 
        'agencia_sede', 'clientes_primarios_id_cliente_primario'
    ];


    public $timestamps = false;
}