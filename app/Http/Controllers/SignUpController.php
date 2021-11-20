<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Support\Library\PaymentGateway\SecurePay;
use Illuminate\Support\Str;

class SignUpController extends Controller
{
    public function index() {

        $plans = Plan::all();
        
        return view('signup.index', [ 'plans' => $plans ]);
    }

    public function review($id) {
        $plan = Plan::findOrFail($id);
        $user = User::find( Auth::id() );
        return view('signup.review', [ 
            'plan' => $plan ,
            'user' => $user
        ]);
    }

    public function go(Request $request, $payment_gateway) {
        $user = User::find( Auth::id() );
        $plan = Plan::find($request->plan_id);

        switch($payment_gateway) {
            case 'securepay' :

                $sp = new SecurePay;
                $payment_data = [
                    'buyer_name' => $user->name,
                    'buyer_email' => $user->email,
                    'buyer_phone' => $request->buyer_phone,
                    'callback_url' => 'https://bootcamp.test/signup/callback/securepay',
                    'order_number' => Str::random(10),
                    'product_description' => 'Bayaran Pelan '.$plan->name.' untuk '.$user->name,
                    'redirect_url' => 'https://bootcamp.test/signup/thankyou/securepay',
                    'transaction_amount' => number_format( ($plan->price / 100), 2, '.', '' )
                ];

                Payment::create([
                    'payment_gateway' => 'securepay',
                    'order_number' => $payment_data['order_number'],
                    'amount' => $payment_data['transaction_amount'],
                    'transaction_data' => json_encode($payment_data),
                    'status' => 'pending',
                    'user_id' => Auth::id()
                ]);

                $sp->process($payment_data);

                break;
        }
    }
}
