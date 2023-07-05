<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Sanctions;
use Illuminate\Http\Request;

class SanctionsController extends Controller
{
    public function index(){
        $sanction = Sanctions::all();
        return view('admin.sanction.index', compact('sanction'));
    }
}
