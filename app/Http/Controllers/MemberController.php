<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    // --- /member
    public function index() {

        $subscription = Subscription::where('user_id', Auth::id() )->first();

        return view('dashboard', [ 'subscription' => $subscription ] );
    }

    // --- /member/profile
    public function profile() {
        return view('member.profile');
    }

    // --- /member/login 
    public function login() {
        return view('member.login');
    }

    // --- /member/register 
    public function register() {
        return view('member.register');
    }

}
