<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Session;
use App\Models\Payments;
use App\Models\Sanctions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /////Count total numbers of users
        $totalUsers = User::count();

        $sessionId = Session::latest()->first();

        /////////Count total numbers of users that are sanction
        $sanction = Sanctions::all();
        $sess = $sanction->count();


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

        //user balance
        $logged = User::find(Auth::id());
        $Balance = $logged->balance;



        return view('home',[
            'data'=>$data, 
            'months'=>$months, 
            'monthCount'=>$monthCount,
            'totalUsers'=>$totalUsers,
            'sess'=>$sess,
            'id'=>$id,

            'sumsgraph'=>$sumsgraph,
            'session_id_graph'=>$session_id_graph,
            'Balance'=>$Balance
        ]);
    }

    public function profile(){
        $user = User::find(Auth::id());
        return view('user-profile', compact('user'));
    }

    public function edit(){
        $user = User::find(Auth::id());
        return view('edit-profile', compact('user'));
    }

    public function update(Request $request){
        $user = User::find(Auth::id());

        $user->name = $request->name;
        $user->email = $request->email;

        $user->update();
        return redirect('/user-profile')->with('status', 'Profile Updated successfully');

    }
}
