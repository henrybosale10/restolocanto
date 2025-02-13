
<x-app-layout>
    <div class="container mx-auto py-8">
        <h2 class="text-3xl font-bold mb-6 text-center text-green-600">Confirmer votre commande</h2>

        @if (!empty($cartItems))
            <div class="max-w-7xl mx-auto bg-white shadow-lg rounded-lg p-6">
                <!-- Grid Layout for Items -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($cartItems as $item)
                        <div class="flex flex-col items-center bg-gray-50 shadow-md rounded-lg p-4 transition-transform duration-300 hover:scale-105">
                            <!-- Product Image -->
                            <div class="w-32 h-32 bg-gradient-to-tr from-green-500 to-green-400 rounded-full shadow-lg flex justify-center items-center mb-4">
                                <img
                                    src="{{ $item->platClient->image ? Storage::url($item->platClient->image) : asset('images/default.png') }}"
                                    alt="{{ $item->platClient->nom }}"
                                    class="w-20 h-20 object-cover rounded-full">
                            </div>

                            <!-- Product Details -->
                            <h1 class="text-lg font-bold text-gray-800 mb-1">{{ $item->platClient->nom }}</h1>
                            <p class="text-sm text-gray-600">Quantité : {{ $item->quantity }}</p>

                            <!-- Pricing -->
                            <div class="mt-4 text-center">
                                <span class="text-lg font-bold text-green-700">{{ number_format($item->platClient->prix, 2) }} CDF</span>
                                <p class="text-sm text-gray-500">Sous-total : {{ number_format($item->platClient->prix * $item->quantity, 2) }} CDF</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Total Price -->
                <div class="p-6 text-right bg-gray-50 mt-6 rounded-lg shadow-md">
                    <h3 class="text-xl font-bold text-gray-800">Total : <span class="text-green-700">{{ number_format($totalPrice, 2) }} CDF</span></h3>
                </div>

                <!-- Confirm Button -->
                <div class="p-6 text-center">
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg focus:outline-none transition duration-300 shadow-lg">
                            Confirmer la commande
                        </button>
                    </form>
                </div>
            </div>
        @else
            <p class="text-gray-500 text-center mt-4">Votre panier est vide.</p>
        @endif
    </div>
</x-app-layout>
