<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>{{ config("app.name", "henofood") }}</title>

        <!-- Fonts -->
        <link
            rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"
        />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
            rel="stylesheet"
        />

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />

        <!-- Scripts -->
        <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
        <script src="{{ asset('js/app.js') }}" defer></script>

        <style>
            /* Texte invisible par défaut */
            .nav-item span {
                opacity: 0;
                transform: translateY(10px);
                transition: all 0.3s ease-in-out;
            }

            /* Texte visible au survol */
            .nav-item:hover span {
                opacity: 1;
                transform: translateY(0);
            }

            /* Centrage vertical et horizontal des icônes et du texte */
            .nav-item {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                position: relative;
                color: #333;
                text-decoration: none;
                transition: color 0.3s ease-in-out;
            }

            /* Marges pour icônes */
            .nav-item i {
                margin-bottom: 5px;
            }

            /* Animation au survol des icônes */
            .nav-item:hover i {
                transform: scale(1.2) rotate(10deg); /* Légère rotation et agrandissement */
                transition: transform 0.3s ease;
            }

            /* Demi-cercle caché par défaut */
            .nav-item::after {
                content: "";
                position: absolute;
                bottom: 0;
                left: 50%;
                transform: translateX(-50%) scaleX(0);
                width: 60%;
                height: 3px;
                background-color: transparent;
                transition: transform 0.3s ease-in-out,
                    background-color 0.3s ease-in-out;
                opacity: 0;
            }

            /* Effet de survol pour chaque onglet */
            .nav-item.home:hover::after {
                background: linear-gradient(
                    90deg,
                    orange,
                    yellow
                ); /* Effet dégradé pour Accueil */
                transform: translateX(-50%) scaleX(1);
                opacity: 1;
            }

            .nav-item.category:hover::after {
                background: linear-gradient(
                    90deg,
                    #3498db,
                    #2ecc71
                ); /* Dégradé pour Catégorie */
                transform: translateX(-50%) scaleX(1);
                opacity: 1;
            }

            .nav-item.menu:hover::after {
                background: linear-gradient(
                    90deg,
                    #2ecc71,
                    #1abc9c
                ); /* Dégradé pour Menu */
                transform: translateX(-50%) scaleX(1);
                opacity: 1;
            }

            .nav-item.reservation:hover::after {
                background: linear-gradient(
                    90deg,
                    #e74c3c,
                    #e67e22
                ); /* Dégradé pour Réservation */
                transform: translateX(-50%) scaleX(1);
                opacity: 1;
            }

            .nav-item.about:hover::after {
                background: linear-gradient(
                    90deg,
                    #9b59b6,
                    #8e44ad
                ); /* Dégradé pour À propos */
                transform: translateX(-50%) scaleX(1);
                opacity: 1;
            }

            /* Animation de lumière au survol */
            .nav-item:hover::before {
                content: "";
                position: absolute;
                top: -5px;
                left: -5px;
                right: -5px;
                bottom: -5px;
                border: 2px solid transparent;
                border-radius: 10px;
                background: linear-gradient(
                    90deg,
                    rgba(255, 255, 255, 0.5),
                    rgba(255, 255, 255, 0)
                );
                filter: blur(4px);
                animation: glow 0.8s ease-in-out infinite;
                z-index: -1;
            }

            /* Effet "glow" */
            @keyframes glow {
                0% {
                    opacity: 0.3;
                    transform: scale(0.9);
                }
                50% {
                    opacity: 0.7;
                    transform: scale(1);
                }
                100% {
                    opacity: 0.3;
                    transform: scale(0.9);
                }
            }

            /* Couleur et transition du texte au survol */
            .nav-item:hover {
                color: inherit;
            }

            /* Profil utilisateur positionné à droite */
            .user-profile {
                position: fixed;
                top: 20px;
                right: 100px;
                z-index: 999;
                display: flex;
                align-items: center;
            }

            /* Espacement autour de l'image du profil */
            .user-profile img {
                margin-right: 5px;
            }

            /* Icône de menu mobile positionnée à droite */
            .mobile-menu-icon {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 1000;
            }

            /* Style pour l'onglet actif */
            .nav-item.active {
                color: inherit;
                border-bottom: 2px solid currentColor;
            }
        </style>
    </head>
    <body>
        <div
            class="bg-white shadow-md"
            x-data="{ open: false, showSecondary: false }"
        >
            <!-- Barre de navigation principale -->
            <nav
                class="container px-6 py-4 mx-auto flex justify-between items-center"
            >
                <!-- Logo -->
                <div class="flex justify-center logo-container">
                    <img
                        src="{{ asset('images/henofood.png') }}"
                        alt="HenoFood"
                        class="w-16 h-16 rounded-full border-2 border-gray-200"
                    />
                </div>

                <!-- Menu principal -->
                <div class="hidden md:flex space-x-8 items-center">
                    <a
                        href="/"
                        class="nav-item text-gray-700 font-bold {{ request()->is('/') ? 'home active' : '' }}"
                    >
                        <i class="fas fa-home text-xl"></i>
                        <span>ACCUEIL</span>
                    </a>
                    <a
                        href="{{ route('categories.index') }}"
                        class="nav-item text-gray-700 font-bold {{ request()->is('categories*') ? 'category active' : '' }}"
                    >
                        <i class="fas fa-th-large text-xl"></i>
                        <span>CATEGORIE</span>
                    </a>
                    <a
                        href="{{ route('menus.index') }}"
                        class="nav-item text-gray-700 font-bold {{ request()->is('menus*') ? 'menu active' : '' }}"
                    >
                        <i class="fas fa-utensils text-xl"></i>
                        <span>NOTRE MENU</span>
                    </a>
                    <a
                        href="{{ route('reservations.create') }}"
                        class="nav-item text-gray-700 font-bold {{ request()->is('reservations*') ? 'reservation active' : '' }}"
                    >
                        <i class="fas fa-calendar-check text-xl"></i>
                        <span>RESERVATION</span>
                    </a>
                    <a
                        href="{{ route('avis_commentaire.index') }}"
                        class="nav-item text-gray-700 font-bold {{ request()->is('avis_commentaire*') ? 'about active' : '' }}"
                    >
                        <i class="fas fa-info-circle text-xl"></i>
                        <span>A PROPOS</span>
                    </a>
                </div>

                <!-- Boutons pour mobile -->
                <div class="flex items-center space-x-4">
                    <!-- Ouvrir/fermer la deuxième barre -->
                    <button
                        @click="showSecondary = !showSecondary"
                        class="text-gray-700 hover:text-green-500"
                    >
                        <i class="fas fa-bars text-2xl"></i>
                    </button>

                    <!-- Menu mobile principal -->
                    <button
                        @click="open = !open"
                        class="text-gray-700 hover:text-green-500 md:hidden mobile-menu-icon"
                    >
                        <i class="fas fa-ellipsis-v text-2xl"></i>
                    </button>
                </div>
            </nav>

            <!-- Profil utilisateur statique -->
            @auth
            <div class="user-profile">
                <div class="relative">
                    <div
                        class="w-10 h-10 rounded-full border-2 border-blue-500"
                    >
                        <img
                            src="{{ auth()->user()->profile_picture ? asset('storage/' . auth()->user()->profile_picture) : asset('images/default-avatar.png') }}"
                            alt="Profil utilisateur"
                            class="w-full h-full rounded-full object-cover"
                        />
                    </div>
                    <span
                        class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border border-white"
                    ></span>
                </div>
            </div>

            @endauth

            <!-- Deuxième barre de navigation -->
            <div
            x-show="showSecondary"
            class="bg-gray-200 py-4 px-6 shadow-md flex justify-between items-center"
        >
            @auth
            <!-- Panier -->
            <a
                href="{{ route('cart.index') }}"
                class="nav-item relative text-gray-700 hover:text-green-500 flex items-center"
            >
                <i class="fas fa-shopping-cart text-2xl"></i>
                <span>Panier</span>
            </a>

            <!-- Notifications -->
            <a
                href="{{ route('notifications.index') }}"
                class="nav-item relative text-gray-700 hover:text-green-500 flex items-center"
            >
                <i class="fas fa-bell text-2xl"></i>
                <span>Notifications</span>
                <!-- Afficher le nombre de notifications non lues -->
                @if(auth()->user()->unreadNotifications->count() > 0)
                <span
                    class="absolute top-0 right-0 bg-red-500 text-white text-xs rounded-full px-2"
                >
                    {{ auth()->user()->unreadNotifications->count() }}
                </span>
                @endif
            </a>

            <!-- Messages -->
            <a
                href="{{ url('/conversation') }}"
                class="nav-item text-gray-700 hover:text-green-500 flex items-center"
            >
                <i class="fas fa-comment-dots text-2xl"></i>
                <span>Messages</span>
            </a>

            <!-- Profil Utilisateur -->
            <div class="flex items-center">
                <i class="fas fa-user-circle text-2xl text-gray-700"></i>
                <a
                    href="{{ route('profile.show') }}"
                    class="ml-2 text-gray-700 font-semibold hover:text-blue-500"
                >
                    {{ auth()->user()->name }}
                </a>
            </div>

            <!-- Déconnexion -->
            <form
                method="POST"
                action="{{ route('logout') }}"
                class="flex items-center"
            >
                @csrf
                <button
                    type="submit"
                    class="nav-item text-gray-700 hover:text-red-500 flex items-center"
                >
                    <i class="fas fa-power-off text-2xl"></i>
                    <span>Déconnexion</span>
                </button>
            </form>

            @else
            <!-- Connexion (Pour les utilisateurs non authentifiés) -->
            <a
                href="{{ route('login') }}"
                class="nav-item text-gray-700 hover:text-green-500 flex items-center"
            >
                <i class="fas fa-sign-in-alt text-2xl"></i>
                <span>Connexion</span>
            </a>
            @endauth
        </div>

        </div>

        <!-- Contenu principal -->
        <div class="font-sans text-gray-900 antialiased min-h-screen">
            {{ $slot }}
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white p-8">
            <div class="container mx-auto">
                <!-- Conteneur principal pour les trois colonnes -->
                <div class="flex flex-col md:flex-row justify-between gap-8">
                    <!-- Première colonne : HENOFOOD -->
                    <div class="flex-1">
                        <h3 class="text-xl font-bold mb-4">HENOFOOD</h3>
                        <p class="text-gray-400">Votre restaurant de confiance à Kinshasa.</p>
                    </div>

                    <!-- Deuxième colonne : Liens utiles -->
                    <div class="flex-1">
                        <div class="text-xl font-bold mb-4">Liens utiles</div>
                        <div class="flex flex-col space-y-2">
                            <a href="#" class="text-gray-400 hover:text-white">Accueil</a>
                            <a href="#" class="text-gray-400 hover:text-white">Menu</a>
                            <a href="#" class="text-gray-400 hover:text-white">Commandes</a>
                            <a href="#" class="text-gray-400 hover:text-white">Livraison</a>
                            <a href="#" class="text-gray-400 hover:text-white">Conditions d'utilisation</a>
                        </div>
                    </div>

                    <!-- Troisième colonne : Contact -->
                    <div class="flex-1">
                        <div class="text-xl font-bold mb-4">Contact</div>
                        <div class="flex flex-col space-y-2">
                            <p class="text-gray-400">📍 Cité Verte, Avenue Mpumbu, Référence UCC</p>
                            <p class="text-gray-400">📧 <a href="mailto:henrybosale10@gmail.com" class="hover:text-white">henrybosale10@gmail.com</a></p>
                            <p class="text-gray-400">📞 <a href="tel:+243859009681" class="hover:text-white">+243 859 009 681</a></p>
                        </div>
                    </div>
                </div>

                <!-- Section Copyright & Réseaux Sociaux -->
                <div class="border-t border-gray-700 mt-8 pt-8">
                    <div class="flex justify-between items-center">
                        <div class="text-gray-400">
                            © 2023 HENOFOOD. Tous droits réservés.
                        </div>
                        <div class="flex space-x-4">
                            <!-- Icône Facebook -->
                            <a href="#" class="text-gray-400 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.407.593 24 1.325 24H12.82v-9.294H9.692v-3.622h3.128V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.463.099 2.795.143v3.24l-1.918.001c-1.504 0-1.795.715-1.795 1.763v2.313h3.587l-.467 3.622h-3.12V24h6.116c.733 0 1.325-.593 1.325-1.325V1.325C24 .593 23.407 0 22.675 0z"/>
                                </svg>
                            </a>
                            <!-- Icône Instagram -->
                            <a href="#" class="text-gray-400 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                            <!-- Icône Twitter -->
                            <a href="#" class="text-gray-400 hover:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bouton pour retourner en haut -->
            <button onclick="window.scrollTo({ top: 0, behavior: 'smooth' })" class="fixed bottom-8 right-8 bg-gray-700 text-white p-3 rounded-full shadow-lg hover:bg-gray-600 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
                </svg>
            </button>
        </footer>
    </body>
</html>
