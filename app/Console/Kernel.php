<?php

namespace App\Console;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Session;

use App\Models\Sanctions;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function(){
            $session = Session::latest()->first();

            if (Carbon::now()->gt($session->end_date)) {

                $usersWithoutPayment = User::whereDoesntHave('payment', function ($query) use ($session) {
                    $query->where('session_id', $session->id);
                })->get();

                foreach ($usersWithoutPayment as $user) {
                    $sanction = new Sanctions();

                    $sanction->user_id = $user->id;
                    $sanction->session_id = $session->id;
                    $sanction->reason = 'Absence de payement';
                    $sanction->save();
                }

                
            }
            else {
                
            }
        })->everyMinute();
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
