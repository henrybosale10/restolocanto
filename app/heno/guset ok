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
                <!-- Connexion -->
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
        <footer class="bg-gray-800 border-t border-gray-200 mt-8">
            <div class="container px-4 py-6 mx-auto text-center text-white">
                &copy; {{ date("Y") }} HenoFood. Tous droits réservés.
            </div>
        </footer>
    </body>
</html>
