<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cat_pasta_emp extends Model
{
    use HasFactory;

    protected $table = 'cat_pasta_emp';

    protected $primaryKey = "id";

    protected $fillable = [
        'descricao', 'id_empreendimento','nome', 'id_pasta'
    ];


    public $timestamps = false;

    function pasta()
    {
        return $this->hasOne(Pastas::class, 'id', 'id_pasta');
    }
}