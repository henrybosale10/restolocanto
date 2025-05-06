<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <!-- Affichage du message de succès avec une animation et style amélioré -->
        @if (session('success'))
            <div id="flash-message" class="mb-6 p-4 bg-green-600 text-white rounded-lg shadow-md animate__animated animate__fadeIn">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3 text-white" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-7V9a1 1 0 112 0v2h2a1 1 0 110 2h-4a1 1 0 110-2h2z" clip-rule="evenodd"/>
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="flex justify-between mb-6 items-center">
            <!-- Barre de recherche -->
            <div class="flex items-center w-full md:w-1/2">
                <input
                    type="text"
                    id="searchMenu"
                    class="w-full p-2 border rounded-lg"
                    placeholder="Rechercher un plat..."
                    oninput="filterMenu()"
                />
                <button
                    id="searchToggleButton"
                    class="ml-2 p-2 bg-gray-600 text-white rounded-lg"
                    onclick="toggleSearch()"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-4-4m0 0l-4 4m4-4V5m0 0l4 4-4 4" />
                    </svg>
                </button>
            </div>

            <!-- Boutons de tri -->
            <div class="flex ml-4 space-x-2">
                <button
                    class="p-2 bg-gray-600 text-white rounded-full hover:bg-gray-700"
                    onclick="sortMenu('alphabeticalAZ')"
                >
                    A-Z
                </button>
                <button
                    class="p-2 bg-gray-600 text-white rounded-full hover:bg-gray-700"
                    onclick="sortMenu('alphabeticalZA')"
                >
                    Z-A
                </button>
                <button
                    class="p-2 bg-gray-600 text-white rounded-full hover:bg-gray-700"
                    onclick="sortMenu('random')"
                >
                    Aleatoire
                </button>
            </div>
        </div>

        <!-- Message 'Plat non trouvé' si aucun résultat -->
        <div id="noResultsMessage" class="hidden text-red-600 font-semibold text-center mb-6">
            Plat non trouvé
        </div>

        <div class="grid lg:grid-cols-4 gap-8 md:grid-cols-2 sm:grid-cols-1" id="menuGrid">
            @foreach ($menus as $menu)
            <div class="menu-item max-w-xs mx-4 mb-6 bg-white rounded-lg shadow-lg overflow-hidden transition-transform transform hover:scale-105">
                <img class="w-full h-48 object-cover object-center" src="{{ Storage::url($menu->image) }}" alt="{{ $menu->nom }}" />
                <div class="px-6 py-4">
                    <div class="flex mb-2">
                        <span class="px-4 py-0.5 text-sm bg-red-500 rounded-full text-red-50">{{ $menu->categorie }}</span>
                    </div>
                    <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase hover:text-green-800 cursor-pointer transition-colors">
                        {{ $menu->nom }}
                    </h4>
                    <p class="leading-normal text-gray-700 text-sm">{{ $menu->description }}</p>
                </div>
                <!-- Prix toujours en bas -->
                <div class="flex items-center justify-center p-4 bg-gray-50 border-t-2 border-gray-200">
                    <span class="text-xl font-semibold text-green-600 font-mono">{{ $menu->prix }} CDF</span>
                </div>

                <div class="flex justify-center items-center pb-4">
                    @if(Auth::check())
                        <form action="{{ route('cart.add') }}" method="POST" class="flex items-center">
                            @csrf
                            <input type="hidden" name="platclient_id" value="{{ $menu->id }}">
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center">
                                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M3 3h2l3 9h6l3-9h2a1 1 0 110 2h-1.5l-2.7 7.3a1 1 0 01-.95.7H7.45a1 1 0 01-.95-.7L3.5 5H2a1 1 0 110-2h1z" />
                                </svg>
                                <span>Ajouter</span>
                            </button>
                        </form>
                    @else
                        <form action="{{ route('cart.add') }}" method="POST" class="flex items-center">
                            @csrf
                            <input type="hidden" name="platclient_id" value="{{ $menu->id }}">
                            <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors flex items-center">
                                <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M3 3h2l3 9h6l3-9h2a1 1 0 110 2h-1.5l-2.7 7.3a1 1 0 01-.95.7H7.45a1 1 0 01-.95-.7L3.5 5H2a1 1 0 110-2h1z" />
                                </svg>
                                <span>Ajouter</span>
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <script>
        // Fonction de filtrage pour la recherche des menus
        function filterMenu() {
            const searchQuery = document.getElementById('searchMenu').value.toLowerCase();
            const menuItems = document.querySelectorAll('.menu-item');
            let noResults = true;

            menuItems.forEach(item => {
                const menuName = item.querySelector('h4').textContent.toLowerCase();
                if (menuName.includes(searchQuery)) {
                    item.style.display = 'block'; // Afficher l'élément
                    noResults = false;
                } else {
                    item.style.display = 'none'; // Masquer l'élément
                }
            });

            // Afficher/masquer le message 'Plat non trouvé'
            const noResultsMessage = document.getElementById('noResultsMessage');
            if (noResults) {
                noResultsMessage.style.display = 'block';
            } else {
                noResultsMessage.style.display = 'none';
            }
        }

        // Fonction de tri des menus
        function sortMenu(sortBy) {
            const menuItems = Array.from(document.querySelectorAll('.menu-item'));
            let sortedItems = [];

            if (sortBy === 'alphabeticalAZ') {
                sortedItems = menuItems.sort((a, b) => {
                    const nameA = a.querySelector('h4').textContent.trim().toLowerCase();
                    const nameB = b.querySelector('h4').textContent.trim().toLowerCase();
                    return nameA.localeCompare(nameB);
                });
            } else if (sortBy === 'alphabeticalZA') {
                sortedItems = menuItems.sort((a, b) => {
                    const nameA = a.querySelector('h4').textContent.trim().toLowerCase();
                    const nameB = b.querySelector('h4').textContent.trim().toLowerCase();
                    return nameB.localeCompare(nameA);
                });
            } else if (sortBy === 'random') {
                sortedItems = menuItems.sort(() => Math.random() - 0.5);
            }

            // Réafficher les éléments triés
            const menuGrid = document.getElementById('menuGrid');
            sortedItems.forEach(item => menuGrid.appendChild(item)); // Réorganise les éléments dans l'ordre trié
        }
    </script>
</x-guest-layout>
