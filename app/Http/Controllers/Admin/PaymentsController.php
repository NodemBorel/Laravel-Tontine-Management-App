<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payments;
use App\Models\Sanctions;
use App\Models\Session;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function index(){

        $sessionId = Session::latest()->first();
        $payment = Payments::where('session_id', $sessionId->id)->get();

        return view('admin.payment.index', compact('payment'));
    }
}
