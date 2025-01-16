<?php

namespace App\Functions;
use Illuminate\Http\JsonResponse;

class Validacao 
{

    public static function mensagem($status, $mensagem_texto){

        return response()->json([
            'status' => false,
            'message' => $mensagem_texto,
        ]);
    } 

}