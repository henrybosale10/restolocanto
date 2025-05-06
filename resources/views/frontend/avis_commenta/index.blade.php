<x-guest-layout>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        primary: {
                            light: '#4338ca', // indigo-800
                            dark: '#f97316', // orange-500
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>

    <main class="container mx-auto px-6 py-20">
        <!-- About Section -->
        <section id="about" class="mb-20 pt-16 animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-bold mb-4 text-primary-light dark:text-primary-dark text-center">
                Bonjour, Nous Sommes Locanto
            </h1>
            <p class="text-xl mb-8 text-center">
                Locanto est un groupe de développeurs passionnés, créateurs de solutions numériques innovantes.
                Découvrez notre plateforme HenoFood, dédiée à la gestion des réservations du restaurant RestoJad.
            </p>
            <div class="text-center">
                <a href="#contact" class="bg-primary-light dark:bg-primary-dark text-white px-6 py-3 rounded-full font-semibold hover:bg-opacity-90 transition-colors duration-300">
                    Prenons contact
                </a>
            </div>
        </section>

        <!-- Projects Section -->
        <section id="projects" class="mb-20 animate-fade-in-up" style="animation-delay: 0.2s;">
            <h2 class="text-3xl font-bold mb-8 text-primary-light dark:text-primary-dark text-center">Nos Projets</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- RestoJad Reservation Platform -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 relative group">
                    <h3 class="text-xl font-semibold mb-2">Plateforme de Réservation - RestoJad</h3>
                    <p class="mb-4 flex justify-center items-center">
                        <i class="fab fa-js-square text-yellow-500 text-xl mr-2"></i>
                        <i class="fab fa-laravel text-red-500 text-xl mr-2"></i>
                        <i class="fab fa-tailwindcss text-blue-400 text-xl mr-2"></i>
                        Plateforme intuitive pour réserver une table chez RestoJad, construite avec Next.js, Laravel, et Tailwind CSS.
                    </p>
                </div>

                <!-- Gestion de Produit - VB.Net -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 relative group">
                    <h3 class="text-xl font-semibold mb-2">Gestion de Produits - VB.Net</h3>
                    <p class="mb-4 flex justify-center items-center">
                        <i class="fab fa-windows text-blue-400 text-xl mr-2"></i>
                        Application de gestion de produits pour un magasin, réalisée en VB.Net, permettant la gestion des stocks, des commandes et des ventes.
                    </p>
                </div>

                <!-- Gestion d'Inscription - Django -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 relative group">
                    <h3 class="text-xl font-semibold mb-2">Gestion d'Inscription - Ecole Saint Ignace</h3>
                    <p class="mb-4 flex justify-center items-center">
                        <i class="fab fa-python text-yellow-500 text-xl mr-2"></i>
                        <i class="fab fa-django text-green-500 text-xl mr-2"></i>
                        Système d'inscription pour l'Ecole Saint Ignace, développé avec Django pour simplifier l'inscription des étudiants.
                    </p>
                </div>

                <!-- Mouvement Armée des Petits Anges - Flask -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 transform hover:scale-105 relative group">
                    <h3 class="text-xl font-semibold mb-2">Gestion du Mouvement Armée des Petits Anges</h3>
                    <p class="mb-4 flex justify-center items-center">
                        <i class="fab fa-python text-yellow-500 text-xl mr-2"></i>
                        <i class="fab fa-flask text-blue-400 text-xl mr-2"></i>
                        Système de gestion des activités pour l'Armée des Petits Anges, développé avec Flask pour gérer les membres et événements.
                    </p>
                </div>
            </div>
        </section>


        <!-- History Section -->
        <section id="about" class="mb-20 pt-16 animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 text-primary-light dark:text-primary-dark text-center">
                Notre Histoire
            </h1>
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-6 md:mb-0">
                    <p class="text-lg lg:text-xl text-gray-600 sm:max-w-md mx-auto text-center">
                        Chez Locanto, chaque plat est une aventure gustative unique. Nous offrons une expérience culinaire de qualité, en mettant l'accent sur la fraîcheur des ingrédients et l'innovation.
                    </p>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="w-full h-auto overflow-hidden rounded-lg shadow-2xl sm:rounded-xl">
                        <img src="/images/chef.png" class="object-cover w-full h-full" alt="Chef preparing a dish" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Order Section -->
        <section id="order" class="mb-20 pt-16 animate-fade-in-up">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 text-primary-light dark:text-primary-dark text-center">
                Commande Facile, Paiement Sécurisé, Livraison Rapide
            </h1>
            <p class="text-lg mb-6 text-center text-gray-600">
                Votre satisfaction est notre priorité.
            </p>
            <div class="flex flex-col md:flex-row items-center">
                <div class="md:w-1/2 mb-6 md:mb-0">
                    <p class="text-lg lg:text-xl text-gray-600 sm:max-w-md mx-auto text-center">
                        Commandez facilement, payez en toute sécurité et choisissez la livraison ou le retrait. Notre système optimise chaque étape pour garantir une expérience sans tracas.
                    </p>
                </div>
                <div class="w-full md:w-1/2">
                    <div class="w-full h-auto overflow-hidden rounded-lg shadow-2xl sm:rounded-xl">
                        <img src="/images/transition_order.jpeg" class="object-cover w-full h-full" alt="Order process" />
                    </div>
                </div>
            </div>
        </section>

        <!-- Reviews Section -->
        <section id="contact" class="animate-fade-in-up" style="animation-delay: 0.4s;">
            <h2 class="text-3xl font-bold mb-8 text-primary-light dark:text-primary-dark text-center">Donnez Votre Avis</h2>
            <form action="{{ route('avis_commentaire.store') }}" method="POST" class="max-w-lg mx-auto">
                @csrf
                <div class="mb-4">
                    <label for="contenu" class="block mb-2 font-medium text-gray-800 dark:text-gray-200">Votre message</label>
                    <textarea id="contenu" name="contenu" rows="4" class="w-full px-4 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-primary-light dark:focus:ring-primary-dark" placeholder="Écrivez votre avis ici..." required></textarea>
                </div>

                <!-- Rating -->
                <div class="mb-4">
                    <label for="note" class="block mb-2 font-medium text-gray-800 dark:text-gray-200">Votre note</label>
                    <div class="flex items-center">
                        <input type="range" id="note" name="note" min="1" max="5" step="1" class="w-full" oninput="updateProgressBar(this.value)">
                        <span id="noteDisplay" class="ml-4 text-lg font-bold text-primary-light dark:text-primary-dark">3</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700 mt-2">
                        <div id="progressBar" class="bg-primary-light h-2.5 rounded-full" style="width: 60%;"></div>
                    </div>
                </div>

                <button type="submit" class="bg-primary-light dark:bg-primary-dark text-white px-6 py-3 rounded-full font-semibold hover:bg-opacity-90">
                    Envoyer votre avis
                </button>
            </form>
        </section>

        <section class="mb-20 animate-fade-in-up" style="animation-delay: 0.2s;">
            <div class="container mx-auto px-6 py-20">
                <h2 class="text-3xl font-bold text-center mb-8 text-primary-light dark:text-primary-dark">Commentaires Existants</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach($avisCommentaires as $avis)
                        <div class="bg-white dark:bg-gray-800 p-6 rounded-xl shadow-lg transform hover:scale-105 transition-all duration-300 ease-in-out group relative">
                            <div class="flex items-center mb-4">
                                <img src="{{ asset('storage/' . $avis->user->profile_picture) }}" alt="Avatar" class="w-12 h-12 rounded-full mr-4 object-cover">
                                <div>
                                    <p class="font-semibold text-gray-800 dark:text-gray-100">{{ $avis->user->name }}</p>
                                    <p class="text-sm text-gray-500 dark:text-gray-300">Posté le {{ $avis->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>

                            <p class="text-gray-700 dark:text-gray-300 mb-4">{{ $avis->contenu }}</p>

                            <div class="flex items-center justify-between mb-4">
                                <!-- Affichage des étoiles de note -->
                                <div class="flex items-center space-x-1 text-yellow-500">
                                    @for($i = 1; $i <= $avis->note; $i++)
                                        <i class="fas fa-star text-yellow-500"></i>
                                    @endfor
                                    @for($i = $avis->note + 1; $i <= 5; $i++)
                                        <i class="far fa-star text-gray-400"></i>
                                    @endfor
                                </div>

                                <div class="flex items-center space-x-4">
                                    <!-- Gestion des likes -->
                                    <form action="{{ route('avis_commentaire.like', $avis->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex items-center text-green-500 hover:text-green-600 transition-colors duration-300">
                                            <i class="fas fa-thumbs-up"></i>
                                            <span class="ml-1 text-sm">{{ $avis->likes->count() }}</span>
                                        </button>
                                    </form>

                                    <!-- Gestion des dislikes -->
                                    <form action="{{ route('avis_commentaire.dislike', $avis->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="flex items-center text-red-500 hover:text-red-600 transition-colors duration-300">
                                            <i class="fas fa-thumbs-down"></i>
                                            <span class="ml-1 text-sm">{{ $avis->dislikes->count() }}</span>
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Affichage des utilisateurs ayant aimé le commentaire au survol -->
                            <div class="absolute inset-x-0 bottom-0 bg-white dark:bg-gray-800 p-4 shadow-lg rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <p class="font-semibold text-gray-800 dark:text-gray-100">Utilisateurs ayant aimé ce commentaire :</p>
                                <div class="flex flex-wrap mt-2">
                                    @foreach($avis->likes as $like)
                                        <div class="mr-4 mb-2 flex items-center">
                                            <img src="{{ asset('storage/' . $like->profile_picture) }}" alt="Avatar" class="w-8 h-8 rounded-full mr-2 object-cover">
                                            <p class="text-sm text-gray-700 dark:text-gray-300">{{ $like->name }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Section de pagination -->
                <div class="mt-6 flex justify-center">
                    {{ $avisCommentaires->links() }}
                </div>
            </div>
        </section>


    </main>

    <script>
        // Function to update the progress bar and rating display
        function updateProgressBar(value) {
            const progressBar = document.getElementById('progressBar');
            const noteDisplay = document.getElementById('noteDisplay');
            const percentage = (value / 5) * 100;
            progressBar.style.width = percentage + '%';
            noteDisplay.textContent = value;
        }
        updateProgressBar(3); // Default value (3)
    </script>
</x-guest-layout>
