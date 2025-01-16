<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Alertas extends Model
{
    use HasFactory;

    protected $table = 'alertas';

    protected $primaryKey = "id";

    protected $fillable = [
        'id_cliente', 'mensagem','cor', 'data', 'visualizado', 'horario'
    ];


    public $timestamps = false;


    
    function clientes() {
        return $this->hasOne(Clientes::class, 'id_cliente', 'id_cliente');
    }
}