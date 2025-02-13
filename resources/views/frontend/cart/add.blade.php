<x-guest-layout>
    <div class="container mx-auto py-8">
        <h1 class="text-4xl font-bold mb-6">Ajouter un Produit au Panier</h1>

        <form method="POST" action="{{ route('cart.add') }}">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-lg font-semibold">Nom du Plat</label>
                <input type="text" name="name" id="name" class="w-full border border-gray-300 px-4 py-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="category" class="block text-lg font-semibold">Catégorie</label>
                <input type="text" name="category" id="category" class="w-full border border-gray-300 px-4 py-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="price" class="block text-lg font-semibold">Prix</label>
                <input type="number" step="0.01" name="price" id="price" class="w-full border border-gray-300 px-4 py-2 rounded-lg" required>
            </div>

            <div class="mb-4">
                <label for="quantity" class="block text-lg font-semibold">Quantité</label>
                <input type="number" name="quantity" id="quantity" class="w-full border border-gray-300 px-4 py-2 rounded-lg" required>
            </div>

            <button type="submit" class="bg-blue-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-blue-600">
                Ajouter au Panier
            </button>
        </form>
    </div>
</x-guest-layout>
