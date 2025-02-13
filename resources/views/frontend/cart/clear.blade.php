<x-guest-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold mb-6">Vider le Panier</h1>

        <p class="text-lg text-gray-700 mb-4">Êtes-vous sûr de vouloir vider votre panier ? Cette action est irréversible.</p>

        <form method="POST" action="{{ route('cart.clear') }}">
            @csrf
            <button type="submit" class="bg-red-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-red-600">
                Oui, Vider le Panier
            </button>
        </form>
    </div>
</x-guest-layout>
