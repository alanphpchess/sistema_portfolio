<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Permissoes extends Model
{
    use HasFactory;

    protected $table = 'permissoes';

    protected $primaryKey = "id";

    protected $fillable = [
        'id_usuario', 'nome','ativo'
    ];


    public $timestamps = false;
}