<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Equipe extends Model
{
    use HasFactory;

    protected $table = 'equipe';

    protected $primaryKey = "id";

    protected $fillable = [
        'id_usuario', 'id_cliente', 'ativo', 'id_user_adm'
    ];


    public $timestamps = false;
}