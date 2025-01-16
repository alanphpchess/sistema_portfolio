<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prod_categoria extends Model
{
    use HasFactory;

    protected $table = 'prod_categoria';

    protected $primaryKey = "id";

    

    protected $fillable = [
        'nome', 'url_image','id_produto'

    ];


    public $timestamps = false;

    function subcategoria()
    {
        return $this->hasMany(prod_subcategoria::class, 'id_categoria', 'id');
    }
}

