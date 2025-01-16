<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produtos_img_brindes extends Model
{
    use HasFactory;

    protected $table = 'produtos_img_brindes';

    protected $primaryKey = "id";

    

    protected $fillable = [
        'id_produto', 'nome', 'url',

    ];


    public $timestamps = false;
}
