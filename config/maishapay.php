<?php

return [
    'gateway_mode' => env('MAISHAPAY_GATEWAY_MODE', 0),
    'public_api_key' => env('MAISHAPAY_PUBLIC_API_KEY', ''),
    'secret_api_key' => env('MAISHAPAY_SECRET_API_KEY', ''),
    'callback_url' => env('MAISHAPAY_CALLBACK_URL', ''),
];
