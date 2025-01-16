<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prod_categoria_brindes extends Model
{
    use HasFactory;

    protected $table = 'prod_categoria_brindes';

    protected $primaryKey = "id";

    

    protected $fillable = [
        'nome', 'url_image','id_produto'

    ];


    public $timestamps = false;

    function subcategoria()
    {
        return $this->hasMany(prod_subcategoria_brindes::class, 'id_categoria', 'id');
    }
}

