<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Utility\EmailUtility;
use Auth;
use Session;

class WalletController extends Controller
{
    public function __construct()
    {
        // Staff Permission Check
        $this->middleware(['permission:view_all_offline_wallet_recharges'])->only('offline_recharge_request');
    }

    public function index()
    {
        $wallets = Wallet::where('user_id', Auth::user()->id)->latest()->paginate(10);
        return view('frontend.user.wallet.index', compact('wallets'));
    }

    public function recharge(Request $request)
    {
        $data['amount'] = $request->amount;
        $data['payment_method'] = $request->payment_option;

        $request->session()->put('payment_type', 'wallet_payment');
        $request->session()->put('payment_data', $data);

        $decorator = __NAMESPACE__ . '\\Payment\\' . str_replace(' ', '', ucwords(str_replace('_', ' ', $request->payment_option))) . "Controller";
        if (class_exists($decorator)) {
            return (new $decorator)->pay($request);
        }
    }

    public function wallet_payment_done($payment_data, $payment_details)
    {
        $user = Auth::user();
        $user->balance = $user->balance + $payment_data['amount'];
        $user->save();

        $wallet = new Wallet;
        $wallet->user_id = $user->id;
        $wallet->amount = $payment_data['amount'];
        $wallet->payment_method = $payment_data['payment_method'];
        $wallet->payment_details = $payment_details;
        $wallet->save();

        // customer Account Opening Email to Admin
        if ( $user != null && (get_email_template_data('wallet_recharge_email_to_customer', 'status') == 1)) {
            try {
                EmailUtility::wallet_recharge_email('wallet_recharge_email_to_customer', $user, $payment_data['amount'], $payment_data['payment_method']);
            } catch (\Exception $e) {}
        }

        Session::forget('payment_data');
        Session::forget('payment_type');

        flash(translate('Recharge completed'))->success();
        return redirect()->route('wallet.index');
    }

    public function wallet_payment_done1($payment_data, $payment_details)
    {
        $user = Auth::user();
        $user->balance = $user->balance + $payment_data['amount'];
        $user->save();

        $wallet = new Wallet;
        $wallet->user_id = $user->id;
        $wallet->amount = $payment_data['amount'];
        $wallet->payment_method = $payment_data['payment_method'];
        $wallet->payment_details = $payment_details;
        $wallet->save();
        
        // customer Account Opening Email to Admin
        if ( $user != null && (get_email_template_data('wallet_recharge_email_to_customer', 'status') == 1)) {
            try {
                EmailUtility::wallet_recharge_email('wallet_recharge_email_to_customer', $user, $payment_data['amount'], $payment_data['payment_method']);
            } catch (\Exception $e) {}
        }
        
        Session::forget('payment_data');
        Session::forget('payment_type');
        flash(translate('Recharge completed'))->success();
    }

    public function wallet_payment_email_test(){
        $user = Auth::user();
        EmailUtility::wallet_recharge_email('wallet_recharge_email_to_customer', $user, 500, 'Votku');
        echo 'OK';
    }
    
    public function offline_recharge(Request $request)
    {
        $wallet = new Wallet;
        $wallet->user_id = Auth::user()->id;
        $wallet->amount = $request->amount;
        $wallet->payment_method = $request->payment_option;
        $wallet->payment_details = $request->trx_id;
        $wallet->approval = 0;
        $wallet->offline_payment = 1;
        $wallet->reciept = $request->photo;
        $wallet->save();
        flash(translate('Offline Recharge has been done. Please wait for response.'))->success();
        return redirect()->route('wallet.index');
    }

    public function offline_recharge_request(Request $request)
    {
        $wallets = Wallet::where('offline_payment', 1);
        $type = null;
        if ($request->type != null) {
            $wallets = $wallets->where('approval', $request->type);
            $type = $request->type;
        }
        $wallets = $wallets->orderBy('id','desc')->paginate(10);
        return view('manual_payment_methods.wallet_request', compact('wallets', 'type'));
    }

    public function updateApproved(Request $request)
    {
        $wallet = Wallet::findOrFail($request->id);
        $wallet->approval = $request->status;
        if ($request->status == 1) {
            $user = $wallet->user;
            $user->balance = $user->balance + $wallet->amount;
            $user->save();
        } else {
            $user = $wallet->user;
            $user->balance = $user->balance - $wallet->amount;
            $user->save();
        }
        if ($wallet->save()) {
            return 1;
        }
        return 0;
    }
}
