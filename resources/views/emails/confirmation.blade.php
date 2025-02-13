<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande</title>
</head>
<body>
    <h1>Bonjour {{ $details['prenom'] }} {{ $details['nom'] }},</h1>
    <p>Nous vous remercions pour votre commande. Voici les détails :</p>
    <ul>
        <li>Numéro de commande : {{ $details['order_id'] }}</li>
        <li>Total : {{ $details['total'] }} CDF</li>
        <li>Date : {{ $details['date'] }}</li>
    </ul>
    <p>Nous espérons vous revoir bientôt !</p>
    <p>Équipe {{ config('app.name') }}</p>
</body>
</html>
