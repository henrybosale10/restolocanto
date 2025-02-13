<x-guest-layout>
    <div class="container mx-auto py-6">
        <h2 class="text-2xl font-bold mb-4">Détails de la commande #{{ $order->id }}</h2>

        <div class="bg-white shadow rounded-lg p-6">
            <!-- Tableau des éléments de la commande -->
            <table class="table-auto w-full">
                <thead>
                    <tr class="text-left">
                        <th class="px-4 py-2">Article</th>
                        <th class="px-4 py-2">Prix</th>
                        <th class="px-4 py-2">Quantité</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->orderItems as $item)
                        <tr>
                            <td class="px-4 py-2">{{ $item->platClient->nom }}</td>
                            <!-- Formater le prix -->
                            <td class="px-4 py-2">{{ number_format($item->platClient->prix, 0, ',', ' ') }} FC</td>
                            <td class="px-4 py-2">{{ $item->quantity }}</td>
                            <!-- Formater le sous-total -->

                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Affichage du total -->
            <div class="text-right mt-4">
                <h3 class="text-lg font-bold">Total : {{ number_format($order->total_price, 0, ',', ' ') }} FC</h3>
            </div>

            <!-- Affichage du statut de la commande -->
            <div class="mt-4">
                <h3 class="text-lg font-bold">Statut de la commande :</h3>
                <p class="text-gray-700">{{ ucfirst($order->status) }}</p>
            </div>

            <!-- Affichage des informations de l'utilisateur -->
            <div class="mt-4">
                <h3 class="text-lg font-bold">Informations de l'utilisateur :</h3>
                <p class="text-gray-700">{{ $order->user->name }}</p>
                <p class="text-gray-700">{{ $order->user->email }}</p>
            </div>
        </div>
    </div>
</x-guest-layout>
