<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Dashboard_itens extends Model
{
    use HasFactory;

    protected $table = 'dashboard_itens';

    protected $primaryKey = "id";

    protected $fillable = [
        'id_usuario', 'id_dashboard', 'ordem'
    ];


    public $timestamps = false;

    function Dashboard() {
        return $this->hasOne(Dashboard::class, 'id', 'id_dashboard');
    }


}