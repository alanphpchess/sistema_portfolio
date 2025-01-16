<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Status_evolucao extends Model
{
    use HasFactory;

    protected $table = 'evolucao_status';

    protected $primaryKey = "id";

    protected $fillable = [
        'data_status', 'id_status','id_cliente'
    ];


    public $timestamps = false;

    function status(){
        return $this->hasOne(Status::class, 'id_status', 'id_status');
    }

    function clientes(){
        return $this->hasOne(Clientes::class, 'id_cliente', 'id_cliente' );

    }

    function tags_clientes() {
        return $this->hasOne(Tags_clientes::class, 'cliente_id', 'id_cliente');
        
    }


    
}