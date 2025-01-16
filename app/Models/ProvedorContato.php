<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ProvedorContato extends Model
{
    use HasFactory;

    protected $table = 'provedor_contato';

    protected $primaryKey = "id_provedor_contato";

    protected $fillable = [
        'titulo_provedor_contato',
        'clientes_primarios_id_cliente_primario'
    ];


    public $timestamps = false;
}
