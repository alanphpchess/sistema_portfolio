<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cli_gp_sedes_emp extends Model
{
    use HasFactory;

    protected $table = 'cli_gp_sedes_emp';

    protected $primaryKey = "id";

    protected $fillable = [
         'id_cliente_primario', 'id_sede', 'id_empreendimento', 'id_cliente'
    ];


    public $timestamps = false;

    function Sedes() {
        return $this->hasOne(Sedes::class, 'id_sede', 'id_sede');
    }

    function Empreendimentos() {
        return $this->hasOne(Empreendimentos::class, 'id_empreendimento', 'id_empreendimento');
    }
}