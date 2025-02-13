<x-admin-layout>
    <h1>Modifier la Commande #{{ $commande->id }}</h1>

    <form method="POST" action="{{ route('admin.commandes.update', $commande->id) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="client">Client :</label>
            <input type="text" name="client" value="{{ $commande->client->prenom }} {{ $commande->client->nom }}" disabled>
        </div>

        <div>
            <label for="montant_total">Montant Total :</label>
            <input type="number" name="montant_total" value="{{ $commande->montant_total }}" disabled>
        </div>

        <div>
            <label for="status">Statut :</label>
            <select name="status">
                <option value="en_attente" {{ $commande->status == 'en_attente' ? 'selected' : '' }}>En Attente</option>
                <option value="confirme" {{ $commande->status == 'confirme' ? 'selected' : '' }}>Confirmé</option>
                <option value="payé" {{ $commande->status == 'payé' ? 'selected' : '' }}>Payé</option>
                <option value="annulée" {{ $commande->status == 'annulée' ? 'selected' : '' }}>Annulée</option>
            </select>
        </div>

        <div>
            <button type="submit">Mettre à jour</button>
        </div>
    </form>

    <a href="{{ route('admin.commandes.index') }}">Retour à la liste des commandes</a>
</x-admin-layout>
