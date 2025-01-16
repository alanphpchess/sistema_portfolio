<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\Users;
use App\Models\Usuarios;
use App\Models\Alertas;
use App\Models\Clientes;
use App\Models\Permissoes;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {

        $bd_users =  Users::where('id', auth()->user()->id)->first();


        if (!empty(auth()->user()->id)) {
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
        } else {
            $bd_users =  '';

            $permissoes = '';
            $user = '';
        }


        $notificacoes = Clientes::with(['alertas' => function ($query) {
            $query->select('id', 'id_cliente', 'data', 'mensagem', 'cor')
                ->orderByRaw("STR_TO_DATE(data, '%d/%m/%Y') DESC");
        }])
            ->where('clientes_primarios_id_cliente_primario', $user->clientes_primarios_id_cliente_primario)->whereHas('alertas');


        $bd_usuarios = Usuarios::where('email_usuario', $bd_users->email)->first();

        if (!empty($bd_usuarios)) {

            if ($bd_usuarios->perfil_usuario != 1) {
               $notificacoes = $notificacoes->where('usuarios_id_usuario', $user->id);
            }

        }


        $alertas = [];

        foreach ($notificacoes->get() as $notificacao) {
            $bd_alertas = Alertas::where('id_cliente', $notificacao->id_cliente)->get();
        
            foreach ($bd_alertas as $bd_alerta) {
                $alertas[] = [
                    'data' => $bd_alerta->data,
                    'horario' => $bd_alerta->horario,
                    'mensagem' => $bd_alerta->mensagem,
                    'id_cliente' => $bd_alerta->id_cliente,
                    'cor' => $bd_alerta->cor,
                    'nome_cliente' => $notificacao->nome_cliente,
                    'telefone_cliente' => $notificacao->telefone1_cliente
                ];
            }
        }
        
        $hoje = Carbon::today()->format('d/m/Y');
        
        usort($alertas, function ($a, $b) use ($hoje) {
            $isTodayA = ($a['data'] === $hoje);
            $isTodayB = ($b['data'] === $hoje);
        
            if ($isTodayA && !$isTodayB) {
                return -1;
            } elseif (!$isTodayA && $isTodayB) {
                return 1;
            } else {
                $dataA = Carbon::createFromFormat('d/m/Y', $a['data']);
                $dataB = Carbon::createFromFormat('d/m/Y', $b['data']);
        
                // Ordenar por data decrescente
                $dataComparison = $dataB <=> $dataA;
        
                // Se as datas forem iguais, comparar por horário
                if ($dataComparison === 0) {
                    return $a['horario'] <=> $b['horario']; // Ordenação crescente por horário
                }
        
                return $dataComparison; // Retorna a comparação da data
            }
        });
        
        $hoje = Carbon::today()->format('d/m/Y');
        $qnt_alertas_dia_de_hoje = 0;
        
        foreach ($alertas as $alerta) {
            if ($alerta['data'] === $hoje) {
                $qnt_alertas_dia_de_hoje++;
            }
        }
        
        return view('layouts.app', [
            'user' => $user,
            'permissoes' => $lista_permissao,
            'user_admin' => $user_admin,
            'notifications' => $alertas,
            'qnt_alertas_dia_de_hoje' => $qnt_alertas_dia_de_hoje
        ]);
    }
}
