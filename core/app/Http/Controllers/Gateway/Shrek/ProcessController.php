<?php

namespace App\Http\Controllers\Gateway\Shrek;

use App\Models\Deposit;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Gateway\PaymentController;

class ProcessController extends Controller
{

    public static function process($deposit)
    {
        $send['v_merchant_id'] = 1;

        $send['notify_url'] = 'https://shrek.com';
        $send['cur'] = $deposit->method_currency;
        $send['merchant_ref'] = $deposit->trx;
        $send['memo'] = 'Payment';
        $send['store_id'] = $deposit->user_id;
        $send['custom'] = $deposit->trx;
        $send['Buy'] = round($deposit->final_amo,2);
        $alias = 'crypto';
        $send['view'] = 'user.payment.' . $alias;
        return json_encode($send);
    }

    public function ipn(Request $request)
    {
        $request->validate([
            'transaction_id' => 'required'
        ]);

        $trx = $request->transaction_id;
        $req_url = "https://voguepay.com/?v_transaction_id=$trx&type=json";
        $vougueData = curlContent($req_url);
        $vougueData = json_decode($vougueData);
        $track = $vougueData->merchant_ref;

        $deposit = Deposit::where('trx', $track)->orderBy('id', 'DESC')->first();
        $vogueAcc = json_decode($deposit->gatewayCurrency()->gateway_parameter);
        if ($vougueData->status == "Approved" && $vougueData->merchant_id == $vogueAcc->merchant_id && $vougueData->total == getAmount($deposit->final_amo) && $vougueData->cur_iso == $deposit->method_currency &&  $deposit->status == '0') {
            //Update User Data
            PaymentController::userDataUpdate($deposit->trx);
        }
    }
}
