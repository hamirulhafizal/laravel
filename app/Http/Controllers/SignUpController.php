<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Support\Library\PaymentGateway\SecurePay;

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

    public function thankyou(Request $request, $payment_gateway) {

        // dd($request);

        switch($payment_gateway) {
            case 'billplz' :
                break;
            case 'ipay88' : 
                break;
            case 'securepay' :
                $sp = new SecurePay;
                $verified = $sp->verify($request);

                // dd($verified);

//                if($verified) {
                if(true) {
                    $payment = Payment::where('order_number', $request->order_number)->first();

                    $transaction_data = json_decode( $payment->transaction_data );
                    // $transaction_data->duration 

                    if (($request->payment_status == 'true') 
                        && ($payment->status != 'paid')) {
                        
                        $payment->status = 'paid';
                        $payment->save();

                        // -- to update or create subscription record

                        $subscription = Subscription::firstOrCreate([
                            'user_id' => $payment->user_id
                        ]);

                        /**
                         * - memberhsip dia memang dah expire 
                         * --- expire_at = today + duration
                         * 
                         * - membership dia belum expire
                         * --- expire_at = expire_at + duration
                         * 
                         * - dia ahli baru
                         * --- expire_at = today + duration
                         */

                        $today = Carbon::now();
                        // dd($subscription->expire_at);

                        $expire_at = new Carbon( $subscription->expire_at );

                        if (($subscription->expire_at === null) 
                            || ($expire_at->lessThan($today) )) {
                                $subscription->expire_at = $today->addDays( $transaction_data->duration );
                        } else {
                            $subscription->expire_at = $expire_at->addDays( $transaction_data->duration );
                        }

                        $subscription->last_payment_id = $payment->id;

                        $subscription->save();

                    }
                } else {
                    // non verified payment --- to log attempt
                }

                break;
        }

        return view('signup.thankyou');

    }

    public function go(Request $request, $payment_gateway) {
        $user = User::find( Auth::id() );
        $plan = Plan::find($request->plan_id);

        switch($payment_gateway) {
            case 'billplz' :
                break;

            case 'ipay88' : 
                break;
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
                    'transaction_amount' => number_format( ($plan->price / 100), 2, '.', '' ),
                    'duration' => $plan->duration,
                    'plan_id' => $plan->id
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
