<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class prod_subcategoria_brindes extends Model
{
    use HasFactory;

    protected $table = 'prod_subcategoria_brindes';

    protected $primaryKey = "id";

    

    protected $fillable = [
        'nome', 'url_image'

    ];


    public $timestamps = false;
}

