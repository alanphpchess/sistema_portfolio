<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Img_empreendimentos extends Model
{
    use HasFactory;

    protected $table = 'img_empreendimentos';

    protected $primaryKey = "id";

    

    protected $fillable = [
        'url_img', 'nome', 'id_empreendimento','id_pasta','nome_original','img_principal'
    ];


    public $timestamps = false;
}

