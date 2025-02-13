<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function checkout(Request $request)
    {
        $data = [
            "gatewayMode" => config('services.maishapay.mode'),
            "publicApiKey" => config('services.maishapay.public_key'),
            "secretApiKey" => config('services.maishapay.secret_key'),
            "montant" => $request->amount,
            "devise" => "USD",
            "callbackUrl" => config('services.maishapay.callback_url'),
        ];

        return view('payment.maishapay', compact('data'));
    }
}
