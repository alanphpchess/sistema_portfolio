<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class tags extends Model
{
    use HasFactory;

    protected $table = 'tags';

    protected $primaryKey = "id";

    protected $fillable = [
        'titulo', 'cor','id_cliente_primario', 'visivel', 'id_tag'
    ];


    public $timestamps = false;
}