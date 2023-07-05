<?php

use App\Models\Session;
use App\Models\Sanctions;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class CheckSessionEnd extends Command
{
    protected $signature = 'session:end';

    protected $description = 'Check if the latest session has ended and create sanctions for users who haven\'t made a payment';

    public function handle()
    {
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

            $this->info('Session has ended. Sanctions created for users who haven\'t made a payment.');
        } else {
            $this->info('Session still ongoing.');
        }
    }
}
