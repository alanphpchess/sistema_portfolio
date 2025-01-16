<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Dashboard_filtro extends Model
{
    use HasFactory;

    protected $table = 'dashboard_filtro';

    protected $primaryKey = "id";

    protected $fillable = [
        'id_usuario', 'filtro_data_inicio', 'filtro_data_fim', 'filtro_corretor', 'filtro_fonte', 'filtro_empreendimento', 'filtro_status'
    ];


    public $timestamps = false;


    function Empreendimentos() {
        return $this->hasOne(Empreendimentos::class, 'id_empreendimento', 'filtro_empreendimento');
    }

    function Users() {
        return $this->hasOne(Users::class, 'id', 'filtro_corretor');
    }

    function Fonte() {
        return $this->hasOne(Fontes::class, 'id_fonte', 'filtro_fonte');
    }

    function Status() {
        return $this->hasOne(Status::class, 'id_status', 'filtro_status');
    }

}