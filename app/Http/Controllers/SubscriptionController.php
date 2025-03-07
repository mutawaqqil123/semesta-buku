<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SubscriptionController extends Controller
{

    public function index()
    {
        $data = [
            'plans' => Plan::get(),
        ];

        return view('landing.subscription.subs-index' ,$data);
    }

    public function store(Plan $plan)
    {
        $userSubscription = Auth::user()->subscription()->where('status', 'active')->orderBy('end_date', 'desc')->first();

        if ($userSubscription) {
            $start_date = \Carbon\Carbon::parse($userSubscription->end_date);
        } else {
            $start_date = now();
        }

        $end_date = $start_date->copy()->addMonths($plan->duration);

        $subscription = Subscription::create([
            'user_id' => Auth::user()->id,
            'plan_id' => $plan->id,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'status' => 'pending'
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $plan->price,
            ),
            'customer_details' => array(
                'first_name' => Auth::user()->name,
                'email' => Auth::user()->email
            ),
        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaction = Transaction::create([
            'subscription_id' => $subscription->token_subs,
            'midtrans_transaction_id' => $snapToken,
            'amount' => $plan->price,
            'status' => 'pending',
            'transaction_time' => now(),
        ]);

        $new = Transaction::where('id', $transaction->token_trans)->first();

        return redirect()->route('subscribe', $new->token_trans);
    }

    public function show(Subscription $subscription)
    {
        //
    }

    public function update(Transaction $transaction)
    {
        // dd($transaction);
        return view('landing.subscription.subs-pay', compact('transaction'));
    }

    public function destroy(Subscription $subs)
    {
        $subs->delete();
        return redirect()->back()->with('succes', 'Berhasil Menghapus Data');
    }

    public function success(Transaction $transaction)
    {
        $transaction->update(['status' => 'success']);
        Subscription::where('id', $transaction->subscription_id)->update(['status' => 'active']);

        return redirect()->route('user.subs')->with('success', 'Akun Anda sudah Premium');
    }

    public function userSubs()
    {
        $data = [
            'subcribes' => Subscription::with(['transactions'])->where('user_id', Auth::user()->id)->get(),
        ];
        return view('profile.user-subscription', $data);
    }
}
