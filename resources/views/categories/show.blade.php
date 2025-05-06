<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <!-- Titre de la page -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-green-600 mb-4">Explorez nos Menus</h2>
            <p class="text-lg text-gray-700 max-w-3xl mx-auto">
                Découvrez une sélection de plats exquis, chacun soigneusement préparé pour satisfaire toutes vos envies culinaires. Cliquez sur un plat pour voir plus de détails et passer votre commande.
            </p>
        </div>

        <!-- Grille des menus -->
        <div class="grid lg:grid-cols-4 gap-8 md:grid-cols-2 sm:grid-cols-1">
            @foreach ($plat->platClients as $menu)
            <div class="max-w-xs mx-4 mb-6 bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
                <!-- Image du plat -->
                <img class="w-full h-48 object-cover object-center" src="{{ Storage::url($menu->image) }}" alt="{{ $menu->nom }}" />

                <div class="px-6 py-4">
                    <!-- Lien vers la page du plat -->
                    <a href="{{ route('categories.show', $menu->id) }}" class="block">
                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase hover:text-amber-700 cursor-pointer transition-colors">
                            {{ $menu->nom }}
                        </h4>
                    </a>
                    <!-- Description du plat -->
                    <p class="leading-normal text-gray-700 text-sm">
                        {{ $menu->description }}
                    </p>

                    <!-- Prix -->
                    <div class="mt-3">
                        <p class="text-xl font-bold text-gray-900">
                            Prix : {{ number_format($menu->prix,
                             2, ',', ' ') }} CDF
                        </p>
                    </div>

                    <!-- Formulaire pour ajouter au panier -->
                    <div class="mt-4">
                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="platclient_id" value="{{ $menu->id }}">
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-full flex items-center justify-center space-x-2 hover:bg-green-700 transition-colors">
                                <span>Ajouter</span>
                                <!-- Nouvelle icône (Icône plus) -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-plus-circle" viewBox="0 0 16 16">
                                    <path d="M8 0a8 8 0 1 0 8 8A8 8 0 0 0 8 0zM7 4a.5.5 0 0 1 .5.5V7H9a.5.5 0 0 1 0 1H7.5V9a.5.5 0 0 1-1 0V8H5a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 7 4z"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>
