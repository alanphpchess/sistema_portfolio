<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Fontes extends Model
{
    use HasFactory;

    protected $table = 'fontes';

    protected $primaryKey = "id_fonte";

    protected $fillable = [
        'titulo_fonte', 'id_cliente_primario'
    ];


    public $timestamps = false;
}