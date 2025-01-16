<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Cat_pasta extends Model
{
    use HasFactory;

    protected $table = 'cat_pasta';

    protected $primaryKey = "id";

    protected $fillable = [
        'descricao', 'id_empreendimento','nome', 'id_pasta'
    ];


    public $timestamps = false;

    function pasta()
    {
        return $this->hasOne(pastas::class, 'id', 'id_pasta');
    }
}