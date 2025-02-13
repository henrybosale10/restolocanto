<x-admin-layout>
    <h1>Votre paiement a été annulé.</h1>
    <p>La commande #{{ $commande->id }} a été annulée. Vous pouvez essayer de passer la commande à nouveau.</p>

    <a href="{{ route('admin.commandes.index') }}">Retour à la liste des commandes</a>
</x-admin-layout>
