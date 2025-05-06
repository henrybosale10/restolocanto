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
                    <!-- Titre principal -->
                    <h3 class="text-3xl font-bold mb-4 text-indigo-600 dark:text-indigo-400">Bienvenue chez RIKU24</h3>

                    <!-- Premier paragraphe -->
                    <p class="mb-4 bg-indigo-50 dark:bg-indigo-900 p-4 rounded-lg text-gray-700 dark:text-gray-200">
                        RIKU24 est bien plus qu'une simple plateforme : c'est votre partenaire dédié à la gestion complète de votre restaurant. Conçue pour simplifier votre quotidien, notre solution tout-en-un vous permet de gérer vos menus, vos réservations, ainsi que toutes les interactions avec vos clients et votre équipe, le tout sur une interface moderne et intuitive.
                    </p>

                    <!-- Sous-titre : Histoire et Spécialités -->
                    <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-300 mb-2 bg-gradient-to-r from-indigo-500 to-purple-500 text-white p-2 rounded-lg">
                        Notre Histoire et Nos Spécialités
                    </h4>

                    <!-- Paragraphe sur l'histoire -->
                    <p class="mb-4 bg-purple-50 dark:bg-purple-900 p-4 rounded-lg text-gray-700 dark:text-gray-200">
                        RIKU24 incarne l'essence de la cuisine traditionnelle africaine, alliant authenticité et modernité. Depuis nos débuts, nous nous efforçons de proposer une expérience culinaire unique, mettant en avant des plats riches en saveurs et en histoire. Notre menu reflète la diversité et la richesse des traditions culinaires africaines, tout en s'adaptant aux goûts contemporains.
                    </p>

                    <!-- Paragraphe sur les ingrédients -->
                    <p class="mb-4 bg-pink-50 dark:bg-pink-900 p-4 rounded-lg text-gray-700 dark:text-gray-200">
                        Nous sélectionnons avec soin des ingrédients frais et locaux, issus de producteurs partenaires, pour garantir une qualité exceptionnelle à chaque plat. Chez RIKU24, nous croyons en une cuisine qui respecte les traditions tout en innovant pour surprendre et ravir nos clients.
                    </p>

                    <!-- Sous-titre : Rôles et Responsabilités -->
                    <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-300 mb-2 bg-gradient-to-r from-pink-500 to-red-500 text-white p-2 rounded-lg">
                        Rôles et Responsabilités de l'Administrateur
                    </h4>

                    <!-- Paragraphe sur les responsabilités -->
                    <p class="mb-4 bg-red-50 dark:bg-red-900 p-4 rounded-lg text-gray-700 dark:text-gray-200">
                        En tant qu'administrateur, vous jouez un rôle central dans le succès de RIKU24. Vous êtes responsable de la supervision des opérations quotidiennes, de la gestion des utilisateurs, de la configuration des menus, et de l'analyse des données pour optimiser les performances du restaurant. Votre mission est de garantir une expérience fluide et professionnelle, tant pour vos clients que pour votre équipe.
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
