<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produtos_img extends Model
{
    use HasFactory;

    protected $table = 'produtos_img';

    protected $primaryKey = "id";

    

    protected $fillable = [
        'id_produto', 'nome', 'url',

    ];


    public $timestamps = false;
}
