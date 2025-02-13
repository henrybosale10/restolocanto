<?php

namespace App\Services;

class MaishaPayService
{
    public function generatePaymentForm($amount, $currency = 'USD')
    {
        $gatewayMode = config('maishapay.gateway_mode');
        $publicApiKey = config('maishapay.public_api_key');
        $secretApiKey = config('maishapay.secret_api_key');
        $callbackUrl = config('maishapay.callback_url');

        return '
            <form action="https://marchand.maishapay.online/payment/vers1.0/merchant/checkout" method="POST">
                <input type="hidden" name="gatewayMode" value="' . $gatewayMode . '">
                <input type="hidden" name="publicApiKey" value="' . $publicApiKey . '">
                <input type="hidden" name="secretApiKey" value="' . $secretApiKey . '">
                <input type="hidden" name="montant" value="' . $amount . '">
                <input type="hidden" name="devise" value="' . $currency . '">
                <input type="hidden" name="callbackUrl" value="' . $callbackUrl . '">
                <input type="submit" value="Payer avec MaishaPay">
            </form>
        ';
    }
}
