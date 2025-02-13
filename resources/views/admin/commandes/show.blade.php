<x-admin-layout>
    <h1>Détails de la Commande</h1>
    <p>Client : {{ $commande->client->prenom }} {{ $commande->client->nom }}</p>
    <p>Montant Total : {{ $commande->montant_total }} FCFA</p>
    <p>Status : {{ $commande->status }}</p>

    <h3>Détails des plats commandés</h3>
    <table>
        <thead>
            <tr>
                <th>Plat</th>
                <th>Quantité</th>
                <th>Sous-Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($commande->commandeDetails as $detail)
                <tr>
                    <td>{{ $detail->platClient->nom }}</td>
                    <td>{{ $detail->quantite }}</td>
                    <td>{{ $detail->sous_total }} FCFA</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</x-admin-layout>
