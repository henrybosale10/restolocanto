<x-app-layout>
    <div class="bg-gradient-to-r from-blue-50 via-purple-50 to-pink-50 min-h-screen">
        <div class="container mx-auto px-8 py-16 space-y-10">

            <!-- Titre principal -->
            <div class="text-center mb-10">
                <h1 class="text-5xl font-extrabold text-gray-900 mb-4">Merci pour votre commande !</h1>
                <p class="text-xl text-gray-600">Votre commande a été enregistrée avec succès. Nous préparons votre livraison.</p>
            </div>

            <!-- Détails de la commande -->
            <div class="bg-white p-8 rounded-xl shadow-xl hover:shadow-2xl transition-all duration-300 mb-10">
                <h2 class="text-3xl font-semibold text-gray-800 mb-6">Détails de la commande</h2>
                <div class="space-y-6">
                    @foreach ($order->orderItems as $orderItem)
                        <div class="flex items-center justify-between border-b pb-4 last:border-b-0">
                            <div>
                                <p class="text-lg font-semibold text-gray-700"><strong>Plat :</strong> {{ $orderItem->nom }}</p>
                                <p class="text-gray-600"><strong>Quantité :</strong> {{ $orderItem->quantity }}</p>
                                <p class="text-gray-600"><strong>Prix unitaire :</strong> {{ $orderItem->price }} CDF</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xl font-bold text-gray-800">Total : {{ $orderItem->price * $orderItem->quantity }} CDF</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <p class="mt-8 text-2xl font-extrabold text-gray-900 text-right">Total général : <span class="text-3xl text-green-600">{{ $order->total_price }} CDF</span></p>
            </div>

            <!-- Section Informations et Options (gauche et droite) -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Informations de Livraison (Gauche) -->
                <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300">
                    <h3 class="text-2xl font-semibold text-gray-800 mb-6">Informations de Livraison</h3>
                    @if ($order->livraison)
                        <div class="space-y-4">
                            <p class="text-gray-700"><strong>Adresse :</strong> {{ $order->livraison->adresse }}</p>
                            <p class="text-gray-700"><strong>Type de livraison :</strong> {{ $order->livraison->type }}</p>
                            <p class="text-gray-700"><strong>Date estimée de livraison :</strong> {{ $order->livraison->date_livraison->format('d-m-Y') }}</p>
                        </div>
                    @else
                        <p class="text-gray-500 italic">Aucune information de livraison disponible.</p>
                    @endif
                </div>

                <!-- Options de Livraison (Droite) -->
                <div class="bg-gradient-to-br from-green-400 via-blue-500 to-indigo-600 p-8 rounded-xl shadow-xl flex items-center justify-center text-center">
                    <div class="space-y-6">
                        <h3 class="text-2xl font-semibold text-white mb-6">Passer à la Livraison</h3>
                        <form action="{{ route('livraisons.create', $order->id) }}" method="GET">
                            <button type="submit"
                                class="px-10 py-4 bg-white text-green-600 font-semibold rounded-lg shadow-lg hover:bg-green-100 transition-all duration-300">
                                Passer à la livraison
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
