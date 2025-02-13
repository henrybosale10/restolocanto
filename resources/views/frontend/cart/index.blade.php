<x-guest-layout>
    <div class="container mx-auto py-10 px-4">
        <h1 class="text-4xl font-bold text-gray-800 mb-6 text-center">Mon Panier</h1>

        @if(session('success'))
            <div class="bg-green-600 text-white p-4 rounded-lg shadow-lg mb-6">
                {{ session('success') }}
            </div>
        @elseif(session('error'))
            <div class="bg-red-600 text-white p-4 rounded-lg shadow-lg mb-6">
                {{ session('error') }}
            </div>
        @endif
        <!-- Bouton Retour vers Menu -->
<div class="mt-4">
    <a href="{{ route('menus.index') }}" class="flex items-center justify-center rounded-md border border-transparent bg-gray-600 px-6 py-3 text-base font-medium text-white shadow-md hover:bg-gray-700 transition duration-300">
        <!-- Icône Retour (Flèche Gauche) -->
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m4 14l7-7-7-7"></path>
        </svg>
        Retour vers le menu
    </a>
</div>


        @if($cart->count() > 0)
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Command Section -->
                <div class="w-full lg:w-2/3 bg-white rounded-lg shadow-xl p-6">
                    <table class="w-full text-sm table-auto border-collapse">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="py-3 px-4 text-left text-gray-700">Image</th>
                                <th class="py-3 px-4 text-left text-gray-700">Plat</th>
                                <th class="py-3 px-4 text-left text-gray-700">Prix</th>
                                <th class="py-3 px-4 text-left text-gray-700">Quantité</th>
                                <th class="py-3 px-4 text-left text-gray-700">Total</th>
                                <th class="py-3 px-4 text-left text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cart as $item)
                                <tr class="hover:bg-gray-50 transition duration-300">
                                    <td class="py-4 px-4">
                                        <img src="{{ $item->platClient->image ? Storage::url($item->platClient->image) : asset('images/default.png') }}"
                                             alt="{{ $item->platClient->nom }}"
                                             class="w-16 h-16 object-cover rounded-md shadow-sm">
                                    </td>
                                    <td class="py-4 px-4">{{ $item->platClient->nom }}</td>
                                    <td class="py-4 px-4">{{ number_format($item->platClient->prix, 2, ',', ' ') }} CDF</td>
                                    <td class="py-4 px-4">
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="w-16 text-center border rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md mt-2 hover:bg-blue-700 transition duration-300">
                                                <!-- Icone Refresh -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4-4m0 0l4 4m-4-4v12m-4 4l-4-4m0 0l-4 4m4-4V4"></path>
                                                </svg> Mettre à jour
                                            </button>
                                        </form>
                                    </td>
                                    <td class="py-4 px-4">{{ number_format($item->quantity * $item->platClient->prix, 2, ',', ' ') }} CDF</td>
                                    <td class="py-4 px-4">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md mt-2 hover:bg-red-700 transition duration-300">
                                                <!-- Icone Trash -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-2 14H7L5 7m14 0H5M10 11v6M14 11v6"></path>
                                                </svg> Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir vider le panier ?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-gray-600 text-white px-6 py-3 rounded-md mt-4 hover:bg-gray-700 transition duration-300">
                            <!-- Icone Trash -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-2 14H7L5 7m14 0H5M10 11v6M14 11v6"></path>
                            </svg> Vider le panier
                        </button>
                    </form>
                </div>

                <!-- Order Summary Section -->
                <div class="w-full lg:w-1/3 bg-white rounded-lg shadow-xl p-6">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-6">Résumé de la commande</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between text-base font-medium text-gray-900">
                            <p>Total Commande</p>
                            <p>{{ number_format($total, 2, ',', ' ') }} CDF</p>
                        </div>
                        <div class="mt-4">
                            <p class="text-sm text-gray-500">Les taxes et frais de livraison seront calculés lors du paiement.</p>
                        </div>
                        <div class="mt-6">
                            <a href="{{ route('orders.create') }}" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-md hover:bg-indigo-700 transition duration-300">
                                <!-- Icone Shopping Cart -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18l-1.68 9.58A2 2 0 0 1 18.36 14H5.64a2 2 0 0 1-1.68-1.42L3 3zm0 0L5 3m0 0l1.5 7.5M5 3h14"></path>
                                </svg> Passer la commande
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <p class="text-center text-gray-600 text-lg">Votre panier est vide.</p>
        @endif
    </div>
</x-guest-layout>
