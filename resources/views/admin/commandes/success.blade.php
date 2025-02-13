<x-admin-layout>
    <h1>Votre paiement a été effectué avec succès!</h1>
    <p>Merci pour votre commande. Elle est maintenant confirmée.</p>
    <p>Commande #{{ $commande->id }} - Montant total: {{ $commande->montant_total }} FCFA</p>

    <a href="{{ route('admin.commandes.index') }}">Retour à la liste des commandes</a>
</x-admin-layout>
