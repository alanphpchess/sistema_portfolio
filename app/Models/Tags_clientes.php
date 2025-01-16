<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Tags_clientes extends Model
{
    use HasFactory;

    protected $table = 'cliente_tags';

    protected $primaryKey = "id";

    protected $fillable = [
        'tag_id', 'cliente_id'
    ];


    public $timestamps = false;

    function tags(){
        return $this->hasOne(Tags::class, 'id', 'tag_id');
    }
}