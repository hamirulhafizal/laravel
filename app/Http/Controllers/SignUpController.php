<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class SignUpController extends Controller
{
    public function index() {

        $plans = Plan::all();
        
        return view('signup.index', [ 'plans' => $plans ]);
    }
}
