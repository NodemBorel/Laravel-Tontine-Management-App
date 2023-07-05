<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use Illuminate\Http\Request;

class SessionsController extends Controller
{
    public function index(Request $request)
    {
  
        $validatedData = $request->validate(
            [
                'start_date' => 'required|date', 
                'end_date' => 'required|date|after:start_date', 
                'amount' => 'required|numeric|min:0', 
            ], 

            [
                'end_date.after' => redirect('admin/dashboard')->with('message', 'The end date must be after the start date'),
                'start_date.before' => redirect('admin/dashboard')->with('message', 'The start date must be before the end date'),
            ]
        );

        $session = new Session();
        $session->end_date = $validatedData['end_date'];
        $session->amount = $validatedData['amount'];
        $session->start_date = $validatedData['start_date'];
        $session->save();

        return redirect('admin/dashboard')->with('message', 'Session created successfully');
    }

}
