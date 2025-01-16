<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\Permissoes;
use App\Models\Users;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
    
        if(!empty(auth()->user()->id)){
            $user =  Users::where('id', auth()->user()->id)->first();

            $bd_users =  Users::where('id', auth()->user()->id)->first();
    
            $permissoes = Permissoes::where('id_usuario', $bd_users->id)->get();
    
            $lista_permissao = [];
            foreach ($permissoes as $permissao) {
                $lista_permissao[$permissao->nome] = $permissao->ativo;
            }
            if ($bd_users->permissao == 'Administrador') {
                $user_admin = 1;
            } else {
                $user_admin = 0;
            }
        }else{
            $bd_users =  '';
    
            $lista_permissao = '';
            $user = '';
            $user_admin =  '';
        }

        return view('layouts.guest',[
            'user' => $user,
            'permissoes' => $lista_permissao,  
            'user_admin' => $user_admin
        ]);
    }
}
