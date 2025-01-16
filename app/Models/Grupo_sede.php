<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Grupo_sede extends Model
{
    use HasFactory;

    protected $table = 'grupo_sede';

    protected $primaryKey = "id";

    protected $fillable = [
        'id_usuario', 'id_cliente_primario', 'id_sede', 'id_empreendimento'
    ];


    public $timestamps = false;

    function Sedes() {
        return $this->hasOne(Sedes::class, 'id_sede', 'id_sede');
    }

    function Empreendimentos() {
        return $this->hasOne(Empreendimentos::class, 'id_empreendimento', 'id_empreendimento');
    }
}