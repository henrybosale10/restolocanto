<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de commande</title>
</head>
<body>
    <h1>Merci pour votre commande!</h1>
    <p>Votre commande numéro <strong>{{ $order->id }}</strong> a été confirmée.</p>
    <p>Montant total : {{ number_format($order->total_price, 2) }} €</p>

    <h3>Détails de la commande :</h3>
    <ul>
        @foreach ($order->orderItems as $item)
            <li>{{ $item->quantity }} x {{ $item->nom }} - {{ number_format($item->price, 2) }} €</li>
        @endforeach
    </ul>

    <p>Merci d’avoir choisi notre service !</p>
</body>
</html>
