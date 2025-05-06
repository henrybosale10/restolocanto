<x-guest-layout>
    <div class="flex flex-col items-center justify-center min-h-screen bg-gray-100 py-12 px-6">
        <h1 class="text-3xl font-bold text-green-500 mb-4">Félicitations, votre paiement a été effectué avec succès !</h1>
        <p class="text-lg text-gray-700 mb-6">Votre commande a bien été validée.</p>
        <a href="{{ route('home') }}" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-300">
            Retour à l'accueil
        </a>
    </div>
</x-guest-layout>
