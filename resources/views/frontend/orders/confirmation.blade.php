<x-app-layout>
    <div class="container mt-5">
        <h1>Merci pour votre commande !</h1>
        <p>Votre commande a été enregistrée avec succès.</p>

        <h2>Détails de la commande</h2>
        <ul>
            @foreach ($order->orderItems as $orderItem)
                <li>
                    <strong>Plat :</strong> {{ $orderItem->nom }}<br>
                    <strong>Quantité :</strong> {{ $orderItem->quantity }}<br>
                    <strong>Prix unitaire :</strong> {{ $orderItem->price }}€<br>
                </li>
            @endforeach
        </ul>

        <p><strong>Total :</strong> {{ $order->total_price }}€</p>

        <div class="mt-8 flex justify-between space-x-4">

            <!-- Option de livraison -->
            <div class="w-1/2 p-4 bg-gray-50 rounded-md shadow-md">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Informations de Livraison</h3>
                @if ($order->livraison)
                    <p><strong>Adresse :</strong> {{ $order->livraison->address }}</p>
                    <p><strong>Type de livraison :</strong> {{ $order->livraison->delivery_type }}</p>
                    <p><strong>Date estimée de livraison :</strong> {{ $order->livraison->estimated_delivery_date->format('d-m-Y') }}</p>
                @else
                    <p>Aucune information de livraison disponible.</p>
                @endif
            </div>

            <!-- Bouton Passer au paiement -->
            <div class="w-1/2 p-4 bg-blue-50 rounded-md shadow-md flex items-center justify-center">
                <div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Passer au Paiement</h3>
                    <form action="{{ route('payment.page', ['orderId' => $order->id]) }}" method="GET">
                        @csrf <!-- Utilise csrf_token si nécessaire -->
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-300">
                            Passer au paiement
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
