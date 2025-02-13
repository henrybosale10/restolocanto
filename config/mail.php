<?php

return [

    'default' => env('MAIL_MAILER', 'smtp'), // Utilise smtp par défaut

    'mailers' => [
        'smtp' => [
            'transport' => 'smtp',
            'host' => env('MAIL_HOST', 'localhost'), // Localhost pour le développement
            'port' => env('MAIL_PORT', 1025),       // Port 1025 pour un serveur local (ex : Mailhog)
            'encryption' => env('MAIL_ENCRYPTION', null), // Pas d'encryption pour un environnement local
            'username' => env('MAIL_USERNAME', null), // Pas de connexion nécessaire pour localhost
            'password' => env('MAIL_PASSWORD', null), // Pas de mot de passe nécessaire pour localhost
            'timeout' => null, // Gardez null si aucun paramètre spécial n'est requis
        ],

        'log' => [
            'transport' => 'log',
            'channel' => env('MAIL_LOG_CHANNEL'),
        ],

        'array' => [
            'transport' => 'array',
        ],

        // Vous pouvez conserver les configurations supplémentaires pour un usage futur
    ],

    'from' => [
        'address' => env('MAIL_FROM_ADDRESS', 'LeRestoJad@gmail.com'), // Adresse e-mail de l'expéditeur
        'name' => env('MAIL_FROM_NAME', 'LeResto'),                   // Nom de l'expéditeur
    ],

    'markdown' => [
        'theme' => 'default',
        'paths' => [
            resource_path('views/vendor/mail'),
        ],
    ],

];
