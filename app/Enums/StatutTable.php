<?php

namespace App\Enums;

enum StatutTable: string {
    case EnAttente = 'en_attente';     // Réservée
    case Disponible = 'disponible';   // Disponible
    case Indisponible = 'indisponible'; // Occupée
}
