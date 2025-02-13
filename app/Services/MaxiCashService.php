<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class MaxicashService
{
    protected $client;
    protected $apiUrl;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiUrl = env('MAXICASH_API_URL');
        $this->apiKey = env('MAXICASH_API_KEY');
    }

    /**
     * Effectuer un paiement via l'API Maxicash
     */
    public function processPayment($amount, $paymentMethod, $orderId)
    {
        try {
            // Préparez les données de paiement en fonction de la méthode choisie
            $paymentData = [
                'api_key' => $this->apiKey,
                'amount' => $amount,
                'currency' => 'CDF',
                'order_id' => $orderId,
                'payment_method' => $paymentMethod,  // Paramètre pour spécifier la méthode de paiement
            ];

            // Ajouter des informations supplémentaires en fonction du mode de paiement
            switch ($paymentMethod) {
                case 'mpesa':
                    $paymentData['mpesa_number'] = env('MPESA_NUMBER');  // Par exemple, numéro M-Pesa pour l'API
                    break;
                case 'orange':
                    $paymentData['orange_number'] = env('ORANGE_NUMBER');  // Par exemple, numéro Orange Money
                    break;
                case 'airtell':
                    $paymentData['airtell_number'] = env('AIRTEL_NUMBER');  // Par exemple, numéro Airtel Money
                    break;
                default:
                    throw new \Exception('Méthode de paiement non supportée');
            }

            // Envoi de la requête POST à l'API Maxicash
            $response = $this->client->post($this->apiUrl . '/payment', [
                'json' => $paymentData
            ]);

            // Décoder la réponse
            $data = json_decode($response->getBody()->getContents(), true);

            if ($data['status'] == 'success') {
                return [
                    'success' => true,
                    'transaction_id' => $data['transaction_id'],
                ];
            } else {
                return [
                    'success' => false,
                    'message' => $data['message'],
                ];
            }
        } catch (\Exception $e) {
            Log::error('Maxicash API Error: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Erreur lors du traitement du paiement.',
            ];
        }
    }
}
