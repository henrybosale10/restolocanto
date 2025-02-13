<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">

        <!-- Titre et discours introductif -->
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-green-600 mb-4">Découvrez nos catégories de plats</h2>
            <p class="text-lg text-gray-700 max-w-3xl mx-auto">
                Explorez une variété de plats soigneusement sélectionnés pour satisfaire toutes vos envies. Que vous soyez amateur de cuisine traditionnelle ou que vous souhaitiez découvrir de nouvelles saveurs, chaque catégorie offre une expérience culinaire unique.
            </p>
        </div>

        <!-- Affichage des plats -->
        <div class="grid lg:grid-cols-4 gap-8 md:grid-cols-2 sm:grid-cols-1">
            @foreach ($plats as $plat)
            <div class="max-w-xs mx-4 mb-6 bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
                <img class="w-full h-48 object-cover object-center" src="{{ Storage::url($plat->image) }}" alt="Image de {{ $plat->nom }}" />
                <div class="px-6 py-4">
                    <a href="{{ route('categories.show', $plat->id) }}" class="block">
                        <!-- Nom du plat avec effet hover -->
                        <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase hover:text-amber-700 cursor-pointer transition-colors">
                            {{ $plat->nom }}
                        </h4>
                    </a>
                    <p class="leading-normal text-gray-700 text-sm">{{ $plat->description }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>
