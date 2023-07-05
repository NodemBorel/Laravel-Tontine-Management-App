<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Session;
use App\Models\Payments;
use App\Models\Sanctions;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function add_payment(Request $request){
        $payment = new Payments;
        $session = Session::latest()->first();

        if(Carbon::now()->gt($session->end_date)){
            $usersWithoutPayment = User::whereDoesntHave('payment', function ($query) use ($session){
                $query->where('session_id', $session->id);
            })->get();

            foreach($usersWithoutPayment as $user){
                $sanction = new Sanctions();

                $sanction->user_id = $user->id;
                $sanction->sessions_id = $session->id;
                $sanction->reason = 'adsence of payment';
                $sanction->save();
            }

            return redirect('/home')->with('status', 'date has already passed');
        }

        $payment->amount = $request->amount;
        if($session->amount == $request->amount)
        {
            $payment->amount = $request->input('amount');
            $payment->user_id = Auth::id();
            $payment->session_id = $session->id;
            $payment->save();
            return redirect('/home')->with('status', 'Payment done');
        }    
        else{
            $amt = $session->amount;
            return redirect('/home')->with('status', 'The session amount is '.$amt);
        }    
    }
}
