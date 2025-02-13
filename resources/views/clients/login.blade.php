<x-admin-layout>
    <div class="container mx-auto py-12">
        <h1 class="text-2xl font-bold mb-6">Connexion</h1>
        <form method="POST" action="{{ route('clients.login.post') }}" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <x-input label="Email" name="email" type="email" required />
            <x-input label="Mot de passe" name="password" type="password" required />
            <button type="submit" class="btn-primary">Se connecter</button>
        </form>
    </div>
</x-admin-layout>
