<x-admin-layout>
    <div class="container mx-auto py-12">
        <h1 class="text-2xl font-bold mb-6">Modifier votre profil</h1>
        <form method="POST" action="{{ route('clients.update') }}" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            @method('PUT')
            <x-input label="Prénom" name="prenom" value="{{ $client->prenom }}" required />
            <x-input label="Nom" name="nom" value="{{ $client->nom }}" required />
            <x-input label="Email" name="email" type="email" value="{{ $client->email }}" required />
            <x-input label="Téléphone" name="telephone" value="{{ $client->telephone }}" required />
            <button type="submit" class="btn-primary">Mettre à jour</button>
        </form>
    </div>
</x-admin-layout>
