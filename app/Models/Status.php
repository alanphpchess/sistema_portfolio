<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Status extends Model
{
    use HasFactory;

    protected $table = 'status';

    protected $primaryKey = "id_status";

    protected $fillable = [
        'titulo_status', 'posicao','clientes_primarios_id_cliente_primario','cor'
    ];


    public $timestamps = false;

    function status_evolucao(){
        return $this->hasOne(Status_evolucao::class, 'id_status', 'id_status');
    }

    function clientes(){
        return $this->hasOne(Clientes::class, 'status_id_status', 'id_status');
    }
}