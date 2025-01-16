<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\prod_categoria;

class produtos_home extends Model
{
    use HasFactory;

    protected $table = 'produtos_home';

    protected $primaryKey = "id";

    public $timestamps = false;


    protected $fillable = [
        'categoria', 'produtos_id', 'subtitulo', 'titulo',  'url_image', 'categoria_id'

    ];

    function prod_categoria() {
        return $this->hasOne(prod_categoria::class, 'categoria_id', 'id');

    }
    
}

