<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MaishaPayService;

class MaishaPayController extends Controller
{
    protected $maishaPayService;

    public function __construct(MaishaPayService $maishaPayService)
    {
        $this->maishaPayService = $maishaPayService;
    }

    public function pay($amount)
    {
        $paymentForm = $this->maishaPayService->generatePaymentForm($amount);
        return view('payment.maishapay', compact('paymentForm'));
    }

    public function callback(Request $request)
    {
        $status = $request->input('status');
        $transactionRefId = $request->input('transactionRefId');
        $operatorRefId = $request->input('operatorRefId');

        if ($status == 202) {
            return redirect()->route('order.success')->with('success', 'Paiement réussi !');
        } else {
            return redirect()->route('order.failed')->with('error', 'Paiement échoué !');
        }
    }
}
