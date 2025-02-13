<x-guest-layout>
    <!-- Section principale avec carrousel d'images -->
    <section>
      <div id="background-slider" class="container w-[84%] h-[210px] py-10 mx-auto text-left bg-center bg-no-repeat bg-cover md:max-w-none md:text-center rounded-xl shadow-lg transition-all duration-500 ease-in-out opacity-100" style="background-image: url('{{ asset('images/henofood.webp') }}');">
        <h1 class="font-mono text-2xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500 md:text-center sm:leading-none lg:text-4xl">
          <i class="fas fa-utensils mr-3 text-xl"></i> <!-- Icône de fourchette et couteau -->
          <span class="inline md:block">Bienvenue chez Locanto</span>
        </h1>
        <div class="flex flex-col items-center mt-12 text-center">
          <span class="relative inline-flex w-full md:w-auto">
            <a href="{{ route('reservations.create') }}" class="inline-flex items-center justify-center px-4 py-1.5 text-sm font-medium leading-5 text-white bg-green-600 rounded-full lg:w-full md:w-auto hover:bg-green-500 focus:outline-none transition-all duration-300 ease-in-out">
              <i class="fas fa-calendar-check text-base mr-1"></i> Réservez ici
            </a>
          </span>
        </div>
        <!-- Boutons de navigation -->
        <div class="absolute top-1/2 left-0 transform -translate-y-1/2 px-4">
          <button id="prev" class="text-black rounded-full p-3 shadow-md hover:bg-gray-700 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-gray-400 transition-all duration-300 ease-in-out"> &#11013; </button>
        </div>
        <div class="absolute top-1/2 right-0 transform -translate-y-1/2 px-4">
          <button id="next" class="text-black rounded-full p-3 shadow-md hover:bg-gray-700 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-gray-400 transition-all duration-300 ease-in-out"> &#10145; </button>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section class="px-2 py-32 bg-white md:px-0">
      <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
        <div class="flex flex-wrap items-center sm:-mx-3">
          <div class="w-full md:w-1/2 md:px-3">
            <div class="w-full pb-6 space-y-4 sm:max-w-md lg:max-w-lg lg:space-y-4 lg:pr-0 md:pb-0">
              <h3 class="text-xl">NOTRE HISTOIRE</h3>
              <h2 class="text-4xl text-green-600">BON APPÉTIT</h2>
              <p class="mx-auto text-base text-gray-500 sm:max-w-md lg:text-xl md:max-w-3xl">
                Chez Locanto, nous croyons que chaque plat raconte une histoire...
              </p>
              <div class="relative flex">
                <a href="{{ route('avis_commentaire.index') }}" class="flex items-center w-full px-6 py-3 mb-3 text-lg text-white bg-green-600 rounded-md sm:mb-0 hover:bg-green-700 sm:w-auto">
                  En Savoir Plus
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
                </a>
              </div>
            </div>
          </div>
          <div class="w-full md:w-1/2">
            <div class="w-full h-auto overflow-hidden rounded-md shadow-xl sm:rounded-xl">
              <img src="/images/chef.png" />
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Commande Section -->
    <section class="px-2 py-32 bg-white md:px-0">
      <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
        <div class="flex flex-wrap items-center sm:-mx-3">
          <div class="w-full md:w-1/2">
            <div class="w-full h-auto overflow-hidden rounded-md shadow-xl sm:rounded-xl">
              <img src="/images/commadewelcom.png" alt="Commande, Paiement et Livraison">
            </div>
          </div>
          <div class="w-full md:w-1/2 md:px-3">
            <div class="w-full pb-6 space-y-4 sm:max-w-md lg:max-w-lg lg:space-y-4 lg:pl-0 md:pb-0">
              <h3 class="text-xl">COMMANDE FACILE, PAIEMENT SÉCURISÉ, LIVRAISON RAPIDE</h3>
              <h2 class="text-4xl text-green-600">VOTRE SATISFACTION, NOTRE PRIORITÉ</h2>
              <p class="mx-auto text-base text-gray-500 sm:max-w-md lg:text-xl md:max-w-3xl">
                Avec Locanto, commander vos plats préférés n’a jamais été aussi simple...
              </p>
              <div class="relative flex">
                <a href="{{ route('menus.index') }}" class="flex items-center w-full px-6 py-3 mb-3 text-lg text-white bg-green-600 rounded-md sm:mb-0 hover:bg-green-700 sm:w-auto">
                  Commander Maintenant
                  <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 ml-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Menu Section -->
    <section class="mt-8 bg-white">
        <div class="mt-4 text-center">
          <h3 class="text-2xl font-bold text-gray-800">Notre Menu</h3>
          <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-blue-500">
            SPÉCIALITÉS DU JOUR
          </h2>
        </div>
        <div class="container w-full px-5 py-6 mx-auto">
          <div class="grid lg:grid-cols-4 gap-6">
            @if ($platClients->isEmpty())
              <div class="col-span-full text-center text-lg text-gray-600">
                Aucune proposition pour le moment
              </div>
            @else
              @foreach ($platClients as $menu)
                <div class="block max-w-xs mx-4 mb-6 rounded-lg shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:scale-105 flex flex-col">
                  <img class="w-full h-48 rounded-t-lg object-cover transition-transform duration-500 ease-in-out transform hover:scale-110" src="{{ Storage::url($menu->image)}}" alt="{{ $menu->nom }}" />
                  <div class="px-6 py-4 bg-white flex-grow">
                    <div class="flex mb-2">
                      <span class="px-4 py-0.5 text-sm bg-red-500 rounded-full text-white">{{ $menu->categorie }}</span>
                    </div>
                    <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">{{ $menu->nom }}</h4>
                    <div class="flex items-center justify-between">
                      <p class="leading-normal text-gray-700 description overflow-hidden line-clamp-5" id="description-{{ $menu->id }}">
                        {{ $menu->description }}
                      </p>
                      <button class="text-blue-500 hover:underline view-more-button" onclick="toggleDescription({{ $menu->id }})" id="button-{{ $menu->id }}">
                        Voir plus <i class="fas fa-arrow-down"></i>
                      </button>
                    </div>
                  </div>
                  <div class="flex items-center justify-between p-4 bg-gray-100 rounded-b-lg">
                    <span class="text-lg font-bold text-green-500">{{ number_format($menu->prix, 0, ',', ' ') }} CDF</span>
                    <span class="text-sm text-gray-500">/ Portion</span>
                  </div>
                </div>

                <!-- Section Détails qui s'affiche après "Voir plus" -->
                <div class="details-section hidden" id="details-{{ $menu->id }}">
                  <div class="p-4 bg-gray-100 rounded-lg mt-4">
                    <h4 class="text-xl font-bold text-green-600">{{ $menu->nom }}</h4>

                    <p class="text-sm text-gray-500 mt-2">Catégorie : {{ $menu->plat->nom }}</p>
                    <p class="text-lg text-gray-500 mt-2"> plat :{{ $menu->description }}</p>

                    <p class="text-sm text-gray-500 mt-2">Prix : <span class="font-bold text-green-500">{{ number_format($menu->prix, 0, ',', ' ') }} CDF</span> / Portion</p>
                    <p class="text-lg text-gray-500 mt-2"> plat :{{ $menu->id }}</p>
                  </div>
                </div>
              @endforeach
            @endif
          </div>
        </div>
      </section>

      <script>
        // Fonction pour afficher plus de description
        function toggleDescription(menuId) {
          var description = document.getElementById('description-' + menuId);
          var button = document.getElementById('button-' + menuId);
          var detailsSection = document.getElementById('details-' + menuId);

          // Vérifie si la description est limitée à 5 lignes ou non
          if (description.style.WebkitLineClamp === '5') {
            // Développer la description
            description.style.WebkitLineClamp = 'unset';
            button.innerHTML = 'Voir moins <i class="fas fa-arrow-up"></i>';
            detailsSection.classList.remove('hidden'); // Afficher la section de détails
          } else {
            // Limiter à 5 lignes
            description.style.WebkitLineClamp = '5';
            button.innerHTML = 'Voir plus <i class="fas fa-arrow-down"></i>';
            detailsSection.classList.add('hidden'); // Cacher la section de détails
          }
        }
      </script>

      <style>
        /* Utilisation de flexbox pour garder le prix en bas de la carte */
        .flex-grow {
          flex-grow: 1;
        }
        .description {
          display: -webkit-box;
          -webkit-line-clamp: 5;
          -webkit-box-orient: vertical;
          overflow: hidden;
        }
      </style>


    <section class="bg-gray-50 px-6 py-16">
        <div class="max-w-screen-xl mx-auto">
            <h2 class="font-extrabold text-black text-center text-4xl mb-12 uppercase tracking-wide">
                Commentaires
            </h2>

            @if($comments->isEmpty())
                <p class="text-center text-gray-500">Aucun commentaire pour le moment.</p>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($comments as $comment)
                        <div class="bg-white shadow-lg rounded-lg p-6 hover:shadow-2xl transition duration-300">
                            <div class="flex items-center space-x-4">
                                <div class="bg-gray-200 w-12 h-12 rounded-full flex items-center justify-center text-xl font-bold text-gray-500">
                                    <img
                                        src="{{ $comment->user->profile_picture ? asset('storage/' . $comment->user->profile_picture) : asset('images/default-avatar.png') }}"
                                        alt="Photo de profil"
                                        class="w-full h-full object-cover rounded-full"
                                    />
                                </div>

                                <div>
                                    <p class="text-lg font-semibold text-gray-800">{{ $comment->user->name }}</p>
                                    <p class="text-sm text-gray-500">Posté le {{ $comment->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>

                            <p class="text-gray-600 mt-4 max-h-16 overflow-hidden line-clamp-2" id="comment-{{ $comment->id }}">
                                {{ Str::limit($comment->contenu, 100) }}
                            </p>

                            @if (strlen($comment->contenu) > 100)
                                <a href="avis"
                                   class="mt-4 text-green-600 hover:underline voir-plus"
                                   data-id="{{ $comment->id }}">
                                   Voir plus
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section class="px-2 py-32 bg-white md:px-0">
        <div class="container items-center max-w-6xl px-8 mx-auto xl:px-5">
            <div class="flex flex-wrap items-center sm:-mx-3">
                <!-- Informations de Contact à gauche -->
                <div class="w-full md:w-1/2 md:px-3 mb-8 md:mb-0 animate__animated animate__fadeInLeft">
                    <div class="w-full pb-6 space-y-4 sm:max-w-md lg:max-w-lg lg:space-y-4 lg:pl-0 md:pb-0">
                        <h3 class="text-xl text-green-600 font-bold">NOUS CONTACTER</h3>
                        <h2 class="text-4xl text-green-600 font-extrabold">PRÊT À VOUS AIDER</h2>
                        <p class="mx-auto text-base text-gray-500 sm:max-w-md lg:text-xl md:max-w-3xl mb-6">
                            Vous avez des questions ou besoin d'assistance ? Voici nos informations de contact :
                        </p>
                        <ul class="space-y-2 text-gray-500">
                            <li class="flex items-center transition-all hover:text-green-600">
                                <i class="fas fa-user text-green-600 mr-2"></i>
                                <span class="font-semibold text-green-600">Nom:</span> Heno Nimer
                            </li>
                            <li class="flex items-center transition-all hover:text-green-600">
                                <i class="fas fa-phone-alt text-green-600 mr-2"></i>
                                <span class="font-semibold text-green-600">Téléphone:</span> 0988 888 888
                            </li>
                            <li class="flex items-center transition-all hover:text-green-600">
                                <i class="fas fa-envelope text-green-600 mr-2"></i>
                                <span class="font-semibold text-green-600">Email:</span> mail8999@hhd.com
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Formulaire de conversation à droite -->
                <div class="w-full md:w-1/2 md:px-3 animate__animated animate__fadeInRight">
                    <div class="w-full pb-6 space-y-4 sm:max-w-md lg:max-w-lg lg:space-y-4 lg:pl-0 md:pb-0">
                        <h3 class="text-xl text-green-600 font-bold">Prenons contact</h3>
                        <form action="{{ route('conversation.send') }}" method="POST" class="max-w-lg mx-auto space-y-6 bg-white p-6 rounded-lg shadow-lg transition-transform transform hover:scale-105">
                            @csrf
                            <div class="mb-4">
                                <textarea name="message" class="w-full px-4 py-2 rounded-lg bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-700 focus:ring-2 focus:ring-primary-light dark:focus:ring-primary-dark transition-transform" required rows="4" placeholder="Écrire un message..."></textarea>
                            </div>
                            <button type="submit" class="bg-green-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-green-700 transition-all transform hover:scale-105">
                                <i class="fas fa-paper-plane mr-2"></i>Envoyer
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>




  </x-guest-layout>
