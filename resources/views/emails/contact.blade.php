<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message de contact</title>
</head>
<body>
    <h1>Message de contact reçu</h1>

    <p><strong>Motif:</strong> {{ e($motif) }}</p>
    <p><strong>Message:</strong> {{ nl2br(e($message)) }}</p>
</body>
</html>
