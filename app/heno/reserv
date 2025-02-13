<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-green-600">
                Merci pour votre réservation !
            </h1>
            <p class="text-lg text-gray-700 mt-4">
                Nous avons bien enregistré votre réservation.
            </p>

            @if (session('reservation'))
            <div
                class="mt-6 text-left bg-gray-100 p-4 rounded shadow-md max-w-xl mx-auto"
            >
                <h2 class="text-2xl font-semibold text-green-600">
                    Détails de votre réservation :
                </h2>
                <ul class="mt-4 space-y-2">
                    <li>
                        <strong>Nom :</strong>
                        {{ session('reservation')->nom }}
                        {{ session('reservation')->prenom }}
                    </li>
                    <li>
                        <strong>Email :</strong>
                        {{ session('reservation')->email }}
                    </li>
                    <li>
                        <strong>Téléphone :</strong>
                        {{ session('reservation')->telephone }}
                    </li>
                    <li>
                        <strong>Date :</strong>
                        {{ session('reservation')->date_reservation }}
                    </li>
                    <li>
                        <strong>Nombre de personnes :</strong>
                        {{ session('reservation')->guest_number }}
                    </li>
                    @if (session('reservation')->table_id)
                    <li>
                        <strong>Table :</strong> Table n°{{ session('reservation')->table_id }}
                    </li>
                    @endif
                </ul>
            </div>
            @endif
        </div>

        <div class="text-center">
            <a
                href="/"
                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                >Retour à l'accueil</a
            >
        </div>
    </div>
</x-guest-layout>
