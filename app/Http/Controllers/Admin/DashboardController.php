<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Session;
use App\Models\Payments;
use App\Models\Sanctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
/////Count total numbers of users
        $totalUsers = User::count();

        ///////Count total numbers of users that paid
        $sessionId = Session::latest()->first();
        $payment = Payments::where('session_id', $sessionId->id)->get();
        $pay = $payment->count();

        /////////Count total numbers of users that are sanction
        $sanction = Sanctions::all();
        $sess = $sanction->count();

        //////////Get the amount cotisated by getting all the amounts int an array using pluck() nad summing
        $payments = Payments::where('session_id', $sessionId->id)->get(['amount']);
        $totalAmount = $payments->pluck('amount')->sum();

        //////////Yaxis of graph of user graph get the months
        $data = User::select('id', 'created_at')->get()->groupBy(function($data){
           return Carbon::parse($data->created_at)->format('M');
        });
        $months = [];
        $monthCount = [];
        $count = 0;
        foreach($data as $month => $values){
            $months[] = $month;
        }

        //// Xaxis of graph user graph
        $users = User::all();
        $id = $users->pluck('id');

        //// Xaxis of graph session_graph
        $paymentgraph = DB::table('payments')
                ->select('session_id', DB::raw('SUM(amount) as total_amount'))
                ->groupBy('session_id')
                ->get();

        $sumsgraph = $paymentgraph->pluck('total_amount');


        //////Yaxis of graph session_graph
        $paygraph = Payments::all();
        $session_id_graph = $paygraph->pluck('session_id');



        return view('admin.dashboard',[
            'data'=>$data, 
            'months'=>$months, 
            'monthCount'=>$monthCount,
            'totalUsers'=>$totalUsers,
            'pay'=>$pay,
            'sess'=>$sess,
            'totalAmount'=>$totalAmount,
            'payments'=>$payments,
            'id'=>$id,

            'sumsgraph'=>$sumsgraph,
            'session_id_graph'=>$session_id_graph
        ]);
        
    }

    public function share(){
        
        $sessionId = Session::latest()->first();
        $payments = Payments::where('session_id', $sessionId->id)->select('amount')->get();

        $totalAmount = $payments->sum('amount');
        $share = $totalAmount / 3;

        $users = User::take(3)->get();

        foreach ($users as $user) {
            $user->balance = $user->balance + $share;
            $user->update();
        }

        return redirect('admin/dashboard')->with('message', 'share successfully'.$users);
    }
}
