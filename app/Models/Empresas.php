<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Empresas extends Model
{
    use HasFactory;

    protected $table = 'clientes_primarios';

    protected $primaryKey = "id";

    protected $fillable = [
        "nome", "razao", "email", "telefone", "celular", "diretorio", "senha", "cnpj", "creci", "cep", "logradouro", "numero", "cidade", "estado", "banco", "tipo_conta", "conta", "agencia", "permissao", "id_roleta", "perc_venda","bairro",'id_cliente_primario'
    ];


    public $timestamps = false;

}