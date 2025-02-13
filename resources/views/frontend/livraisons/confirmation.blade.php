<x-guest-layout>
    <div class="container mx-auto p-8">
        <div class="bg-white p-8 rounded-2xl shadow-2xl max-w-4xl mx-auto transition-all duration-300 hover:shadow-xl">
            <h2 class="text-3xl font-bold mb-8 text-gray-900 flex items-center">
                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                Confirmation de la Livraison
            </h2>

            <div class="mb-8">
                <p class="text-xl text-gray-800 flex items-center">
                    <i class="fas fa-tag text-gray-600 mr-3"></i>
                    <strong>Numéro de commande:</strong> {{ $order->id }}
                </p>
                <p class="text-xl text-gray-800 flex items-center mt-4">
                    <i class="fas fa-euro-sign text-gray-600 mr-3"></i>
                    <strong>Prix total:</strong> {{ $order->total_price }} CDF
                </p>

                <h3 class="mt-6 font-semibold text-2xl text-gray-900 flex items-center">
                    <i class="fas fa-box-open text-blue-500 mr-3"></i>
                    Articles:
                </h3>
                <ul class="list-disc pl-6 mt-4 space-y-4">
                    @foreach($order->orderItems as $item)
                        <li class="text-lg text-gray-700 flex items-center">
                            <i class="fas fa-cogs text-gray-600 mr-3"></i>
                            {{ $item->nom }} - {{ $item->quantity }} x {{ $item->price }} CDF
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="mt-8">
                <h3 class="font-semibold text-2xl text-gray-900 flex items-center">
                    <i class="fas fa-truck text-red-500 mr-3"></i>
                    Mode de livraison
                </h3>
                <p class="text-lg text-gray-700 mt-2 flex items-center">
                    <i class="fas fa-shipping-fast text-gray-600 mr-3"></i>
                    <strong>Type: </strong> {{ $livraison->type }}
                </p>
                <p class="text-lg text-gray-700 mt-2 flex items-center">
                    <i class="fas fa-map-marker-alt text-gray-600 mr-3"></i>
                    <strong>Adresse: </strong> {{ $livraison->adresse }}
                </p>
                <p class="text-lg text-gray-700 mt-2 flex items-center">
                    <i class="fas fa-circle text-gray-600 mr-3"></i>
                    <strong>Statut: </strong> {{ $livraison->statut }}
                </p>

                <p class="text-lg text-gray-700 mt-2 flex items-center">
                    <i class="fas fa-clock text-gray-600 mr-3"></i>
                    <strong>Date et Heure de livraison : </strong>   {{ $livraison->heure_livraison }}
                </p>
            </div>

            <div class="mt-10">
                <a href="{{ route('livraison.payment', ['orderId' => $order->id]) }}" class="btn btn-primary">
                    Passer au paiement
                </a>

            </div>

        </div>
    </div>
</x-guest-layout>
