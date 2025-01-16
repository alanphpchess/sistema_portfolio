<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cat_pasta_clientes extends Model
{
    use HasFactory;

    protected $table = 'cat_pasta_clientes';

    protected $primaryKey = "id";

    protected $fillable = [
        'descricao', 'id_cliente','nome', 'id_pasta'
    ];


    public $timestamps = false;

    function pasta()
    {
        return $this->hasOne(pastas::class, 'id', 'id_pasta');
    }
}