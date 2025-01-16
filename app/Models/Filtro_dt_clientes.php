<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Filtro_dt_clientes extends Model
{
    use HasFactory;

    protected $table = 'filtro_dt_clientes';

    protected $primaryKey = "id";

    protected $fillable = [
        'data_criacao', 'data_atualizacao', 'data_fim', 'id_fonte', 'ids_empreendimentos', 'ids_sedes', 'id_corretor'
    ];


    public $timestamps = false;




    function Usuarios() {
        return $this->hasOne(Users::class, 'id', 'id_corretor');
    }


    function Fontes() {
        return $this->hasOne(Fontes::class, 'id_fonte', 'id_fonte');
    }



}