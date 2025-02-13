<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts & Scripts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.15.0/dist/cdn.min.js" defer></script>
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Custom JavaScript -->
    <script>
        window.addEventListener('DOMContentLoaded', (event) => {
            setTimeout(() => {
                const messages = document.querySelectorAll('.session-message');
                messages.forEach((message) => {
                    message.style.transition = 'opacity 0.5s ease-out';
                    message.style.opacity = '0';
                    setTimeout(() => {
                        message.remove();
                    }, 500);
                });
            }, 1500);
        });
    </script>

    <!-- Custom Styles -->
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
            transform: scale(1.2) rotate(10deg);
            transition: transform 0.3s ease;
        }

        /* Demi-cercle caché par défaut */
        .nav-item::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%) scaleX(0);
            width: 60%;
            height: 3px;
            background-color: transparent;
            transition: transform 0.3s ease-in-out, background-color 0.3s ease-in-out;
            opacity: 0;
        }

        /* Effet de survol pour chaque onglet */
        .nav-item.table:hover::after {
            background: linear-gradient(90deg, orange, yellow);
            transform: translateX(-50%) scaleX(1);
            opacity: 1;
        }

        .nav-item.home:hover::after {
            background: linear-gradient(90deg, orange, yellow);
            transform: translateX(-50%) scaleX(1);
            opacity: 1;
        }

        .nav-item.plat:hover::after {
            background: linear-gradient(90deg, #2cd726, #13074e);
            transform: translateX(-50%) scaleX(1);
            opacity: 1;
        }

        .nav-item.livreur:hover::after {
            background: linear-gradient(90deg, #3498db, #2ecc71);
            transform: translateX(-50%) scaleX(1);
            opacity: 1;
        }

        .nav-item.menu:hover::after {
            background: linear-gradient(90deg, #e0dd1e, #1abc9c);
            transform: translateX(-50%) scaleX(1);
            opacity: 1;
        }
        .nav-item.User:hover::after {
            background: linear-gradient(90deg, #e0dd1e, #1abc9c);
            transform: translateX(-50%) scaleX(1);
            opacity: 1;
        }
        .nav-item.Notification:hover::after {
            background: linear-gradient(90deg, #e0dd1e, #1abc9c);
            transform: translateX(-50%) scaleX(1);
            opacity: 1;
        }
        .nav-item.order:hover::after {
            background: linear-gradient(90deg, #e0dd1e, #1abc9c);
            transform: translateX(-50%) scaleX(1);
            opacity: 1;
        }

        .nav-item.reservation:hover::after {
            background: linear-gradient(90deg, #e74c3c, #e67e22);
            transform: translateX(-50%) scaleX(1);
            opacity: 1;
        }

        .nav-item.User:hover::after {
            background: linear-gradient(90deg, #9b59b6, #8e44ad);
            transform: translateX(-50%) scaleX(1);
            opacity: 1;
        }

        /* Animation de lumière au survol */
        .nav-item:hover::before {
            content: '';
            position: absolute;
            top: -5px;
            left: -5px;
            right: -5px;
            bottom: -5px;
            border: 2px solid transparent;
            border-radius: 10px;
            background: linear-gradient(90deg, rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0));
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

        /* Profil utilisateur positionné à droite */
        .user-profile {
            position: fixed;
            top: 20px;
            right: 100px;
            z-index: 999;
            display: flex;
            align-items: center;
        }

        /* Style pour l'onglet actif */
        .nav-item.active {
            color: inherit;
            border-bottom: 2px solid currentColor;
        }
    </style>
</head>

<body class="antialiased bg-gray-100">
    <div class="flex justify-center logo-container">
        <img src="{{ asset('images/henofood.png') }}" alt="HenoFood" class="w-16 h-16 rounded-full border-2 border-gray-200 object-cover">
    </div>
    <!-- Navbar -->
    <nav class="container px-6 py-4 mx-auto flex justify-between items-center space-x-6">


        <!-- Logo et lien Accueil -->

        <!-- Navigation -->
        <div class="flex space-x-6">
            <a href="{{ route('admin.tables.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/tables*') ? 'table active' : '' }}">
                <i class="bi bi-table text-xl"></i>
                <span>NOS TABLES</span>
            </a>
            <a href="{{ route('admin.reservations.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/reservations*') ? 'reservation active' : '' }}">
                <i class="bi bi-calendar-check text-xl"></i>
                <span>NOS RESERVATIONS</span>
            </a>
            <a href="{{ route('admin.plats.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/plats*') ? 'plat active' : '' }}">
                <i class="bi bi-egg text-xl"></i>
                <span>NOS CATEGORIES</span>
            </a>
            <a href="{{ route('admin.platclients.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/platclients*') ? 'menu active' : '' }}">
                <i class="bi bi-file-earmark text-xl"></i>
                <span>NOS MENUS</span>
            </a>
            <a href="{{ route('admin.clients.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/clients*') ? 'client active' : '' }}">
                <i class="bi bi-person text-xl"></i>
                <span>NOS AUTH</span>
            </a>
            <a href="{{ route('admin.orders.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/orders*') ? 'order active' : '' }}">
                <i class="bi bi-cart text-xl"></i>
                <span>NOS COMMANDES</span>
            </a>
            <a href="{{ route('admin.livreurs.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/livreurs*') ? 'livreur active' : '' }}">
                <i class="bi bi-truck text-xl"></i>
                <span>NOS LIVREURS</span>
            </a>
            <a href="{{ route('admin.avis_commentaires.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/avis_commentaires*') ? 'comment active' : '' }}">
                <i class="bi bi-chat-left-text text-xl"></i>
                <span>NOS AVIS</span>
            </a>
            <a href="{{ route('admin.notifications.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/notifications*') ? 'notification active' : '' }}">
                <i class="bi bi-bell text-xl"></i>
                <span>NOS NOTIF</span>
            </a>
            <a href="{{ route('admin.repondre.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/notifications*') ? 'notification active' : '' }}">
                <i class="bi bi-chat text-xl"></i> <!-- Icône de messages -->
                <span>NOS MESSAGES </span>
            </a>

            <a href="{{ route('home') }}"
   class="nav-item text-gray-700 font-bold {{ request()->is('home*') ? 'home active' : '' }}">
    <i class="bi bi-house text-xl"></i> <!-- Icône de maison -->
    <span>MENU PRINCIPAL</span>
</a>


        </div>

        <!-- Déconnexion -->
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="hover:bg-red-600 rounded-full p-2">
                <i class="bi bi-box-arrow-right"></i> <!-- Icône pour déconnexion -->
            </button>
        </form>
    </nav>

    <!-- Mobile Navigation -->
<div class="mobile-nav fixed top-0 left-0 w-full bg-white shadow-md lg:hidden z-50">
    <div class="flex justify-between items-center px-4 py-3">
        <!-- Logo -->
        <div>
            <img src="{{ asset('images/henofood.png') }}" alt="HenoFood" class="w-12 h-12 rounded-full">
        </div>

        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="text-gray-700 focus:outline-none">
            <i class="bi bi-list text-2xl"></i>
        </button>
    </div>

    <!-- Mobile Menu Items -->
    <div id="mobile-menu" class="hidden flex-col space-y-2 px-4 pb-4 bg-white">
        <a href="{{ route('admin.tables.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/tables*') ? 'table active' : '' }}">
            <i class="bi bi-table"></i>
            <span>NOS TABLES</span>
        </a>
        <a href="{{ route('admin.reservations.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/reservations*') ? 'reservation active' : '' }}">
            <i class="bi bi-calendar-check"></i>
            <span>NOS RESERVATIONS</span>
        </a>
        <a href="{{ route('admin.plats.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/plats*') ? 'plat active' : '' }}">
            <i class="bi bi-egg"></i>
            <span>NOS CATEGORIES</span>
        </a>
        <a href="{{ route('admin.platclients.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/platclients*') ? 'menu active' : '' }}">
            <i class="bi bi-file-earmark"></i>
            <span>NOS MENUS</span>
        </a>
        <a href="{{ route('admin.clients.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/clients*') ? 'client active' : '' }}">
            <i class="bi bi-person"></i>
            <span>NOS USERS</span>
        </a>
        <a href="{{ route('admin.orders.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/orders*') ? 'order active' : '' }}">
            <i class="bi bi-cart"></i>
            <span>NOS COMMANDES</span>
        </a>
        <a href="{{ route('admin.livreurs.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/livreurs*') ? 'livreur active' : '' }}">
            <i class="bi bi-truck"></i>
            <span>NOS LIVREURS</span>
        </a>
        <a href="{{ route('admin.avis_commentaires.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/avis_commentaires*') ? 'comment active' : '' }}">
            <i class="bi bi-chat-left-text"></i>
            <span>NOS AVIS</span>
        </a>
        <a href="{{ route('admin.notifications.index') }}" class="nav-item text-gray-700 font-bold {{ request()->is('admin/notifications*') ? 'notification active' : '' }}">
            <i class="bi bi-bell"></i>
            <span>NOS NOTIIFCATIONS</span>
        </a>
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="text-red-600">
                <i class="bi bi-box-arrow-right"></i>
                <span>Déconnexion</span>
            </button>
        </form>
    </div>
</div>
<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', () => {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>



    <!-- Contenu Principal -->
    <div class="content">
        @if (session()->has('danger'))
            <div class="session-message bg-red-100 text-red-800 px-4 py-3 rounded mb-4">{{ session('danger') }}</div>
        @endif

        @if (session()->has('warning'))
            <div class="session-message bg-yellow-100 text-yellow-800 px-4 py-3 rounded mb-4">{{ session('warning') }}</div>
        @endif

        @if (session()->has('success'))
            <div class="session-message bg-green-100 text-green-800 px-4 py-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <!-- Contenu dynamique -->
        <div class="flex-1 bg-white shadow rounded p-6">
            {{ $slot }}
        </div>
    </div>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>
</html>
