<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\InsertRecordJob;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->everyTwoSeconds();
        $schedule->call(function () {
            // Dados para inserir no banco de dados
            $dataParaInserir = [
                'id_cliente_primario' => '1',
                'id_empreendimento' => '1',
                'nome' => 'teste',
                'email' => 'alan@email.com.br',
                'telefone' => '(11) 111111111',
            ];

            InsertRecordJob::dispatch($dataParaInserir);
        })->everyTwoSeconds()->appendOutputTo(storage_path('schedule.log'));
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    
}
