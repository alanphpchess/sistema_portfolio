<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Img_clientes extends Model
{
    use HasFactory;

    protected $table = 'img_clientes';

    protected $primaryKey = "id";

    

    protected $fillable = [
        'url_img', 'nome', 'id_cliente','id_pasta','nome_original','img_principal'
    ];


    public $timestamps = false;
}

