<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Convites extends Model
{
    use HasFactory;

    protected $table = 'convites';

    protected $primaryKey = "id";

    protected $fillable = [
        'convite_validacao', 'data','email', 'status','id_usuario_convidado','id_usuario_env_email', 'cliente_id'
    ];


    public $timestamps = false;

    function Users() {
        return $this->hasOne(users::class, 'id_usuario_convidado', 'id');
    }
}