<x-admin-layout>
    <div class="container mx-auto py-12">
        <h1 class="text-2xl font-bold mb-6">Inscription</h1>
        <form method="POST" action="{{ route('clients.store') }}" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <x-input label="Prénom" name="prenom" required />
            <x-input label="Nom" name="nom" required />
            <x-input label="Email" name="email" type="email" required />
            <x-input label="Téléphone" name="telephone" required />
            <x-input label="Mot de passe" name="password" type="password" required />
            <x-input label="Confirmer le mot de passe" name="password_confirmation" type="password" required />
            <button type="submit" class="btn-primary">S'inscrire</button>
        </form>
    </div>
</x-admin-layout>
