<x-admin-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <!-- Logo avec Dashboard -->
            <div class="flex items-center gap-2">
                <img src="https://via.placeholder.com/40" alt="Logo" class="w-8 h-8">
                <h2 class="font-semibold text-2xl text-gray-700 dark:text-gray-300 leading-tight">
                    {{ __('Dashboard - RIKU24') }}
                </h2>
            </div>

            <!-- Avatar et Menu déroulant -->
            <div class="relative">
                <button
                    class="w-10 h-10 bg-gray-200 dark:bg-gray-600 rounded-full overflow-hidden focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    id="avatar-button">
                    <img
                        src="https://via.placeholder.com/150"
                        alt="Admin Avatar"
                        class="w-full h-full object-cover">
                </button>

                <!-- Dropdown Menu -->
                <div
                    class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg shadow-lg transform scale-0 origin-top-right transition-all duration-300"
                    id="dropdown-menu">
                    <a href="#"
                       class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-indigo-600 hover:text-indigo-600 dark:hover:text-white rounded-md transition-all duration-200">
                        Profile
                    </a>
                    <a href="#"
                       class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-indigo-600 hover:text-indigo-600 dark:hover:text-white rounded-md transition-all duration-200">
                        Settings
                    </a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="block w-full text-left px-4 py-2 text-sm text-gray-700 dark:text-gray-300 hover:bg-indigo-100 dark:hover:bg-indigo-600 hover:text-indigo-600 dark:hover:text-white rounded-md transition-all duration-200">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-700 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-gray-800 dark:text-gray-100">
                    <h3 class="text-3xl font-bold mb-4 text-indigo-600 dark:text-indigo-400">Bienvenue à RIKU24</h3>
                    <p class="mb-4">
                        RIKU24 est la solution tout-en-un dédiée à la gestion complète de votre restaurant. Nous offrons une plateforme moderne
                        qui vous permet de gérer efficacement vos menus, vos réservations, ainsi que l'ensemble des interactions avec vos clients et votre équipe.
                    </p>
                    <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-300 mb-2">Histoire et Spécialités</h4>
                    <p class="mb-4">
                        RIKU24 est un restaurant réputé pour sa cuisine traditionnelle africaine, mettant en avant des plats riches en saveurs
                        et en histoire. Depuis sa fondation, nous nous engageons à offrir une expérience culinaire inoubliable, avec un menu qui
                        célèbre la diversité culinaire africaine.
                    </p>
                    <p class="mb-4">
                        Chaque plat est préparé avec des ingrédients frais, issus des producteurs locaux, pour offrir à nos clients une expérience
                        gustative unique. Nous mettons un point d'honneur à respecter les traditions culinaires tout en y apportant une touche moderne.
                    </p>
                    <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-300 mb-2">Rôles et Responsabilités de l'Administrateur :</h4>
                    <p class="mb-4">
                        En tant qu'administrateur, vous avez la responsabilité de superviser l'ensemble des opérations du restaurant. Vous êtes en charge
                        de la gestion des utilisateurs, de la configuration du menu, ainsi que de l'analyse des données relatives à l'activité du restaurant.
                    </p>
                </div>

                <!-- Boutons -->

            </div>
        </div>
    </div>

    <!-- Script JavaScript pour l'interactivité -->
    <script>
        // Sélectionner les éléments
        const avatarButton = document.getElementById('avatar-button');
        const dropdownMenu = document.getElementById('dropdown-menu');

        // Ajouter un événement de clic sur l'avatar pour afficher/masquer le menu
        avatarButton.addEventListener('click', () => {
            console.log('Avatar clicked'); // Pour vérifier que l'événement est bien capturé
            dropdownMenu.classList.toggle('scale-0');
            dropdownMenu.classList.toggle('scale-100');
        });

        // Fermer le menu si on clique en dehors de l'avatar ou du menu
        window.addEventListener('click', (event) => {
            if (!avatarButton.contains(event.target) && !dropdownMenu.contains(event.target)) {
                dropdownMenu.classList.add('scale-0');
                dropdownMenu.classList.remove('scale-100');
            }
        });
    </script>
</x-admin-layout>
